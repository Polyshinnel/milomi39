<?php

namespace Database\Seeders;

use App\Models\PriceGroup;
use App\Models\PriceItem;
use App\Models\PriceSection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PriceCatalogSeeder extends Seeder
{
    public function run(): void
    {
        if (PriceSection::exists()) {
            return;
        }

        $massage = $this->section('massage-face-body', 'Массаж лица и тела', 'service_time_price', 'Массаж в Milo Mi — это сочетание заботы о теле, эстетического результата и глубокого расслабления. Техники подбираются индивидуально: от мягких расслабляющих движений до более интенсивной проработки мышц и проблемных зон. Работаем с лицом и телом, снимаем напряжение, улучшаем лимфоотток и тонус тканей, помогаем скорректировать контуры и вернуть ощущение лёгкости. Время для себя, после которого изменения чувствуются и видны.', 'img/service/1.webp', 'Расслабляющие и лифтинг программы', 1);
        $manual = $this->group($massage, 'Ручной массаж тела', 1);
        $device = $this->group($massage, 'Аппаратная коррекция фигуры', 2);
        $this->item($massage, $manual, 'service', 'Общий массаж', 'Индивидуальный подход к каждому клиенту: мастер учитывает ваши пожелания и потребности. Прорабатываются все зоны тела с особым вниманием к проблемным участкам.', 1, [['40 мин', 2300], ['60 мин', 2700], ['90 мин', 3500]]);
        $this->item($massage, $manual, 'procedure', 'Лимфодренажный массаж с элементами расслабления', 'Массаж, направленный на улучшение лимфооттока и обмена веществ.', 2, [['40 мин', 2300], ['60 мин', 2700], ['90 мин', 3500]]);
        $this->item($massage, $device, 'procedure', 'Lipo magic', 'Эффективный способ борьбы с лишней жидкостью, целлюлитом и лишними сантиметрами. Подтягивает кожу и моделирует фигуру безопасно и комфортно.', 1, [['от 60 мин', 2700, true]]);

        $spa = $this->section('spa-programs', 'SPA-программы', 'service_time_price', 'Комплексные ритуалы для глубокого расслабления и восстановления.', 'img/service/2.webp', 'Глубокое восстановление и релаксация', 2);

        $laser = $this->section('laser-hair-removal', 'Лазерная эпиляция', 'service_price', 'Комфортные процедуры для разных зон и выгодные комплексы.', 'img/service/3.webp', 'Комфорт и результат с первой процедуры', 3);
        $complex = $this->group($laser, 'Комплексы', 1);
        foreach ([
            ['Усики', 600, null], ['Подбородок', 1000, null], ['Лицо полностью', 1900, null], ['Подмышки', 800, null],
            ['Подмышки + тотальное бикини', 2400, $complex], ['Подмышки + голени', 2400, $complex],
            ['Подмышки + тотальное бикини + голени', 4100, $complex],
        ] as $index => [$title, $price, $group]) {
            $this->item($laser, $group, 'service', $title, null, $index + 1, [[null, $price]]);
        }

        $cosmetology = $this->section('cosmetology-without-injections', 'Косметология без уколов', 'service_time_price', 'Уходовые процедуры, подобранные под ваши потребности.', 'img/service/5.webp', 'Уход, который работает на ваш результат', 4);
        $rituals = $this->group($cosmetology, 'Ритуалы красоты', 1);
        $this->item($cosmetology, null, 'service', 'Газожидкостный пилинг', null, 1, [['50 мин', 3500]]);
        $this->item($cosmetology, null, 'service', 'Микротоковая терапия', null, 2, [['50 мин', 2700]]);
        $this->item($cosmetology, $rituals, 'procedure', '«Чистый кислород»', 'Атравматичная очищающая процедура с насыщением кожи кислородом. Омолаживает и дарит сияние уже после первой процедуры.', 1, [['60 мин', 4500]]);
        $this->item($cosmetology, $rituals, 'procedure', '«Сияние»', 'Осветляющий уход против тусклости и пигментации. Кожа становится ровной и защищённой от преждевременного старения.', 2, [['60 мин', 4500]]);

        $brands = $this->section('professional-cosmetics', 'Профессиональная косметика', 'purpose_brand', 'Подбор средств для поддержания результата и домашнего ухода.', 'img/service/6.webp', 'Подбор средств для домашнего ухода', 5);
        foreach ([
            ['Для лица', [
                ['Sesderma', 'Испанская космецевтика, созданная на основе научных разработок и инновационных технологий. Эффективные формулы и активные компоненты помогают решать различные эстетические задачи кожи.'],
                ['Angiofarm', 'Профессиональная косметика с акцентом на активный уход, восстановление и поддержание здоровья кожи. Формулы бренда разработаны с вниманием к эффективности и физиологии кожи.'],
            ]],
            ['Для тела', [['Hi Dear', 'Это эстетика красивого ухода за телом. Качественные средства, приятные текстуры и изысканные ароматы превращают обычный уход в настоящий ритуал. Нежный уход, который хочется не просто использовать, а ощущать на коже.']]],
            ['Для волос', [['HADAT', 'Профессиональный уход за волосами с акцентом на восстановление, увлажнение и сохранение их красоты. Современные формулы, продуманные составы и салонное качество позволяют поддерживать результат профессионального ухода дома.']]],
        ] as $groupIndex => [$purpose, $brandItems]) {
            $group = $this->group($brands, $purpose, $groupIndex + 1);
            foreach ($brandItems as $index => [$brand, $description]) {
                $this->item($brands, $group, 'brand', $brand, $description, $index + 1);
            }
        }

        // Keep the local variable explicit: the SPA section intentionally starts without priced entries.
        unset($spa);
    }

    private function section(string $slug, string $title, string $type, string $description, string $image, string $homeDescription, int $order): PriceSection
    {
        $storedImage = 'price-sections/'.basename($image);
        if (! Storage::disk('public')->exists($storedImage) && is_file(public_path($image))) {
            Storage::disk('public')->put($storedImage, file_get_contents(public_path($image)));
        }

        return PriceSection::create([
            'slug' => $slug, 'title' => $title, 'table_type' => $type, 'description' => $description,
            'home_image' => $storedImage, 'home_description' => $homeDescription, 'show_on_home' => true,
            'sort_order' => $order, 'is_active' => true,
        ]);
    }

    private function group(PriceSection $section, string $title, int $order): PriceGroup
    {
        return $section->groups()->create(['title' => $title, 'sort_order' => $order, 'is_active' => true]);
    }

    private function item(PriceSection $section, ?PriceGroup $group, string $type, string $title, ?string $description, int $order, array $variants = []): PriceItem
    {
        $item = $section->items()->create([
            'price_group_id' => $group?->id, 'item_type' => $type, 'title' => $title,
            'description' => $description, 'sort_order' => $order, 'is_active' => true,
        ]);

        foreach ($variants as $index => $variant) {
            [$duration, $price] = $variant;
            $item->variants()->create([
                'duration' => $duration, 'price' => $price, 'price_from' => $variant[2] ?? false,
                'sort_order' => $index + 1,
            ]);
        }

        return $item;
    }
}
