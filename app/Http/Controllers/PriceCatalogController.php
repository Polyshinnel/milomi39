<?php

namespace App\Http\Controllers;

use App\Models\PriceSection;
use App\Models\Review;
use App\Models\SpecialOffer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class PriceCatalogController extends Controller
{
    public function home()
    {
        $sections = PriceSection::active()->where('show_on_home', true)->orderBy('sort_order')->get()
            ->map(fn (PriceSection $section): array => [
                'id' => $section->slug,
                'title' => $section->title,
                'image_url' => $this->imageUrl($section->home_image),
                'description' => $section->home_description,
            ]);

        $specialOffers = SpecialOffer::active()->orderBy('sort_order')->get()
            ->map(fn (SpecialOffer $offer): array => [
                'slug' => $offer->slug,
                'image_url' => $this->imageUrl($offer->home_image),
                'title' => $offer->home_title,
                'description' => $offer->home_description,
            ]);

        $reviews = Review::active()->orderBy('sort_order')->get()
            ->map(fn (Review $review): array => [
                'image_url' => $this->imageUrl($review->image),
            ]);

        return view('home', ['homeServices' => $sections, 'specialOffers' => $specialOffers, 'reviews' => $reviews]);
    }

    public function specialOffer(string $offer)
    {
        $specialOffer = SpecialOffer::active()->where('slug', $offer)->firstOrFail();

        return view('special-offer', [
            'offer' => [
                'title' => $specialOffer->hero_title,
                'description' => $specialOffer->hero_description,
                'image' => $this->imageUrl($specialOffer->hero_image),
            ],
        ]);
    }

    public function priceList()
    {
        $sections = PriceSection::active()
            ->with(['groups' => fn ($query) => $query->where('is_active', true), 'items' => function ($query): void {
                $query->where('is_active', true)->with(['variants' => fn ($variants) => $variants->orderBy('sort_order')]);
            }])
            ->orderBy('sort_order')
            ->get()
            ->map(fn (PriceSection $section): array => $this->toViewData($section));

        return view('price-list', ['priceSections' => $sections]);
    }

    public function imageUrl(?string $path): string
    {
        if (! $path) {
            return asset('img/service/1.webp');
        }

        return str_starts_with($path, 'img/') ? asset($path) : Storage::disk('public')->url($path);
    }

    private function toViewData(PriceSection $section): array
    {
        $groups = $section->groups->keyBy('id');
        $viewGroups = $groups->map(fn ($group): array => [
            'id' => $group->id,
            'title' => $group->title,
            'items' => [],
        ])->all();

        // Preserve the explicit display order of groups and also include ungrouped items.
        $orderedItems = $section->items->groupBy('price_group_id')->flatMap(function (Collection $groupItems, $groupId) use ($groups): Collection {
            if (! $groupId || ! $groups->has($groupId)) {
                return $groupItems->sortBy('sort_order');
            }

            return $groupItems->sortBy('sort_order')->map(fn ($item) => $item->setAttribute('_group_order', $groups->get($groupId)->sort_order));
        })->sortBy(fn ($item): string => sprintf('%010d-%010d', $item->getAttribute('_group_order') ?? -1, $item->sort_order));

        $rows = [];
        $seenGroup = [];
        foreach ($orderedItems as $item) {
            $group = $item->price_group_id ? $groups->get($item->price_group_id) : null;
            $variants = $item->variants->map(fn ($variant): array => [
                'time' => $variant->duration ?? '—',
                'price' => $variant->price === null ? 'Уточнить по телефону' : (($variant->price_from ? 'от ' : '').$this->formatPrice((float) $variant->price)),
            ])->all();

            if (! $variants && $section->table_type !== 'purpose_brand') {
                $variants = [['time' => '—', 'price' => 'Уточнить по телефону']];
            }

            $row = [
                'name' => $item->title,
                'description' => $item->description,
                'variants' => $variants,
                'price' => $variants[0]['price'] ?? '',
                'category' => $group && empty($seenGroup[$group->id]) ? $group->title : null,
            ];

            if ($section->table_type === 'purpose_brand') {
                if ($group) {
                    $viewGroups[$group->id]['items'][] = ['name' => $item->title, 'description' => $item->description];
                }
            } else {
                $rows[] = $row;
            }

            if ($group) {
                $seenGroup[$group->id] = true;
            }
        }

        return [
            'id' => $section->slug,
            'title' => $section->title,
            'description' => $section->description,
            'table_type' => $section->table_type,
            'groups' => array_values(array_filter($viewGroups, fn ($group): bool => $group['items'] !== [])),
            'items' => $rows,
            'category' => $section->title,
            'image_url' => $this->imageUrl($section->home_image),
            'home_description' => $section->home_description,
        ];
    }

    private function formatPrice(float $price): string
    {
        return number_format($price, 0, ',', ' ').' ₽';
    }
}
