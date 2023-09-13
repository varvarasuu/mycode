<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyMediaFile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use App\Models\MediaFile;
use Illuminate\Support\Facades\Http;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'type_short' => 'OOO',
            'type_full' => 'Общество с ограниченной ответственностью',
            'name' => 'АТ-ВОРК',
            'name_full' => 'АТ-ВОРК',
            'inn' => '7804679272',
            'kpp' => '780401001',
            'ogrn' => '1217800007336',
            'ogrn_date' => '1611619200000',
            'okved' => '62.01',
            'okved_text' => 'Разработка компьютерного программного обеспечения',
            'manager_name' => 'Александров Дмитрий Евгеньевич',
            'manager_position' => 'ГЕНЕРАЛЬНЫЙ ДИРЕКТОР',
            'okato' => '40273000000',
            'oktmo' => '40328000000',
            'okfs' => '16',
            'okogu' => '4210014',
            'okpo' => '46942718',
            'type_capital' => 'УСТАВНЫЙ КАПИТАЛ',
            'sum_capital' => '20000',
            'status' => 'ACTIVE',
            'status_text' => 'Действующая организация',
            'address' => '195220, Г.Санкт-Петербург, ВН.ТЕР.Г. МУНИЦИПАЛЬНЫЙ ОКРУГ ГРАЖДАНКА, ПР-КТ ГРАЖДАНСКИЙ, Д. 22, ЛИТЕРА А, ПОМЕЩ. 8Н, ОФИС 310/1',
            'region_id' => 1,
            'account_id' => 10,
            'tax_inspection' => 'Межрайонная инспекция Федеральной налоговой службы №18 по Санкт-Петербургу',
            'short_description' => 'this is short description',
            'website' => 'http://fakewebsite.com',
            'description' => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure? On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee',
            'cover_image_id' => $this->generateImage('uploads/company/cover_image/1'),
            'logo_image_id' => $this->generateImage('uploads/company/logo_image/1'),
        ]);

        Company::create([
            'type_short' => 'OOO',
            'type_full' => 'Общество с ограниченной ответственностью',
            'name' => 'АГЕНТСТВО ЛИНЕЙНОГО ПЕРСОНАЛА МЕН АТ ВОРК',
            'name_full' => 'АГЕНТСТВО ЛИНЕЙНОГО ПЕРСОНАЛА МЕН АТ ВОРК',
            'inn' => '7717756611',
            'kpp' => '771701001',
            'ogrn' => '1137746567628',
            'ogrn_date' => '1372723200000',
            'okved' => '78.10',
            'okved_text' => 'Деятельность агентств по подбору персонала',
            'manager_name' => 'Черняков Олег Михайлович',
            'manager_position' => 'Конкурсный управляющий',
            'okato' => '45280572000',
            'oktmo' => '45358000000',
            'okfs' => '16',
            'okogu' => '4210014',
            'okpo' => '17772149',
            'type_capital' => 'УСТАВНЫЙ КАПИТАЛ',
            'sum_capital' => '5010000',
            'status' => 'ACTIVE',
            'status_text' => 'Действующая организация',
            'address' => 'г Москва, ул Дубовой Рощи, д 25 к 2 стр 1',
            'region_id' => 1,
            'account_id' => 11,
            'tax_inspection' => 'Инспекция Федеральной налоговой службы № 17 по г.Москве',
            'short_description' => 'this is short description',
            'website' => 'http://fakewebsite.com',
            'description' => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure? On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee',
            'cover_image_id' => $this->generateImage('uploads/company/cover_image/2'),
            'logo_image_id' => $this->generateImage('uploads/company/logo_image/2'),
        ]);

        Company::create([
            'type_short' => 'НАО',
            'type_full' => 'Непубличное акционерное общество',
            'name' => 'ОЗОН',
            'name_full' => 'ОЗОН',
            'inn' => '5027068206',
            'kpp' => '502701001',
            'ogrn' => '1035005005188',
            'ogrn_date' => '1045353600000',
            'okved' => '47.30',
            'okved_text' => 'Торговля розничная моторным топливом в специализированных магазинах',
            'manager_name' => 'Сундукова Юлия Викторовна',
            'manager_position' => 'ГЕНЕРАЛЬНЫЙ ДИРЕКТОР',
            'okato' => '46448561000',
            'oktmo' => '46748000061',
            'okfs' => '16',
            'okogu' => '4210014',
            'okpo' => '45769318',
            'type_capital' => 'УСТАВНЫЙ КАПИТАЛ',
            'sum_capital' => '5006400',
            'status' => 'ACTIVE',
            'status_text' => 'Действующая организация',
            'address' => 'Московская обл, г Люберцы, рп Малаховка, Быковское шоссе, д 55А',
            'region_id' => 1,
            'account_id' => 12,
            'tax_inspection' => 'Межрайонная инспекция Федеральной налоговой службы №17 по Московской области',
            'short_description' => 'this is short description',
            'website' => 'http://fakewebsite.com',
            'description' => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure? On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee',
            'cover_image_id' => $this->generateImage('uploads/company/cover_image/3'),
            'logo_image_id' => $this->generateImage('uploads/company/logo_image/3'),
        ]);

        Company::create([
            'type_short' => 'ООО',
            'type_full' => 'Общество с ограниченной ответственностью',
            'name' => 'ГРУППА МНП',
            'name_full' => 'ГРУППА КОМПАНИЙ МОРСКИЕ И НЕФТЕГАЗОВЫЕ ПРОЕКТЫ',
            'inn' => '5263038941',
            'kpp' => '526301001',
            'ogrn' => '1025204411363',
            'ogrn_date' => '1035849600000',
            'okved' => '46.69.9',
            'okved_text' => 'Торговля оптовая прочими машинами, приборами, аппаратурой и оборудованием общепромышленного и специального назначения',
            'manager_name' => 'Овчинников Андрей Александрович',
            'manager_position' => 'ГЕНЕРАЛЬНЫЙ ДИРЕКТОР',
            'okato' => '22401382000',
            'oktmo' => '22701000001',
            'okfs' => '16',
            'okogu' => '4210014',
            'okpo' => '59631894',
            'type_capital' => 'УСТАВНЫЙ КАПИТАЛ',
            'sum_capital' => '1211286828',
            'status' => 'ACTIVE',
            'status_text' => 'Действующая организация',
            'address' => 'г Нижний Новгород, ул Свободы, д 19',
            'region_id' => 1,
            'account_id' => 13,
            'tax_inspection' => 'Межрайонная инспекция Федеральной налоговой службы № 21 по Нижегородской области',
            'short_description' => 'this is short description',
            'website' => 'http://fakewebsite.com',
            'description' => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure? On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee',
            // 'cover_image_path' => 'https://marketplace.canva.com/EAFB2eB7C3o/1/0/1600w/canva-yellow-and-turquoise-vintage-rainbow-desktop-wallpaper-Y4mYj0d-9S8.jpg',
            // 'logo_image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6d/Volkswagen_logo_2019.svg/2048px-Volkswagen_logo_2019.svg.png',
        ]);

        Company::create([
            'type_short' => 'ООО',
            'type_full' => 'Общество с ограниченной ответственностью',
            'name' => 'КБ РБА',
            'name_full' => 'КОММЕРЧЕСКИЙ БАНК РБА',
            'inn' => '7609016017',
            'kpp' => '770601001',
            'ogrn' => '1027600000251',
            'ogrn_date' => '1030924800000',
            'okved' => '64.19',
            'okved_text' => 'Денежное посредничество прочее',
            'manager_name' => 'Романов Михаил Сергеевич',
            'manager_position' => 'ПРЕДСЕДАТЕЛЬ ПРАВЛЕНИЯ"',
            'okato' => '45286596000',
            'oktmo' => '45384000000',
            'okfs' => '16',
            'okogu' => '1500010',
            'okpo' => '21671649',
            'type_capital' => 'УСТАВНЫЙ КАПИТАЛ',
            'sum_capital' => '1450000000',
            'status' => 'ACTIVE',
            'status_text' => 'Действующая организация',
            'address' => 'г Москва, Ленинский пр-кт, д 11 стр 3',
            'region_id' => 1,
            'account_id' => 14,
            'tax_inspection' => 'Инспекция Федеральной налоговой службы № 6 по г. Москве',
            'short_description' => 'this is short description',
            'website' => 'http://fakewebsite.com',
            'description' => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure? On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee',
            // 'cover_image_path' => 'https://marketplace.canva.com/EAFB2eB7C3o/1/0/1600w/canva-yellow-and-turquoise-vintage-rainbow-desktop-wallpaper-Y4mYj0d-9S8.jpg',
            // 'logo_image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6d/Volkswagen_logo_2019.svg/2048px-Volkswagen_logo_2019.svg.png',
        ]);

        Company::create([
            'type_short' => 'ООО',
            'type_full' => 'Общество с ограниченной ответственностью',
            'name' => 'КБ РЕНЕССАНС КРЕДИТ',
            'name_full' => 'КОММЕРЧЕСКИЙ БАНК РЕНЕССАНС КРЕДИТ',
            'inn' => '7744000126',
            'kpp' => '772501001',
            'ogrn' => '1027739586291',
            'ogrn_date' => '1037750400000',
            'okved' => '64.19',
            'okved_text' => 'Денежное посредничество прочее',
            'manager_name' => 'Хондру Татьяна Викторовна',
            'manager_position' => 'ПРЕДСЕДАТЕЛЬ ПРАВЛЕНИЯ',
            'okato' => '45296559000',
            'oktmo' => '45914000000',
            'okfs' => '16',
            'okogu' => '1500010',
            'okpo' => '55000731',
            'type_capital' => 'УСТАВНЫЙ КАПИТАЛ',
            'sum_capital' => '1101000000',
            'status' => 'ACTIVE',
            'status_text' => 'Действующая организация',
            'address' => 'г Москва, ул Кожевническая, д 14',
            'region_id' => 1,
            'account_id' => 15,
            'tax_inspection' => 'Инспекция Федеральной налоговой службы № 25 по г.Москве',
            'short_description' => 'this is short description',
            'website' => 'http://fakewebsite.com',
            'description' => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure? On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee',
            // 'cover_image_path' => 'https://marketplace.canva.com/EAFB2eB7C3o/1/0/1600w/canva-yellow-and-turquoise-vintage-rainbow-desktop-wallpaper-Y4mYj0d-9S8.jpg',
            // 'logo_image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6d/Volkswagen_logo_2019.svg/2048px-Volkswagen_logo_2019.svg.png',
        ]);

        Company::create([
            'type_short' => 'ООО',
            'type_full' => 'Общество с ограниченной ответственностью',
            'name' => 'МК ООО ФЕСТИНА АЛЛИЕНСЕ ЛТД',
            'name_full' => 'МЕЖДУНАРОДНАЯ КОМПАНИЯ ООО ФЕСТИНА АЛЛИЕНСЕ ЛТД',
            'inn' => '2540274779',
            'kpp' => '254001001',
            'ogrn' => '1232500004065',
            'ogrn_date' => '1676592000000',
            'okved' => '77.35',
            'okved_text' => 'Аренда и лизинг воздушных судов и авиационного оборудования',
            'manager_name' => 'Васильев Иван Алексеевич',
            'manager_position' => 'ДИРЕКТОР',
            'okato' => '05401000005',
            'oktmo' => '05701000111',
            'okfs' => '16',
            'okogu' => '4210014',
            'okpo' => '84994313',
            'type_capital' => 'УСТАВНЫЙ КАПИТАЛ',
            'sum_capital' => '3307577600',
            'status' => 'ACTIVE',
            'status_text' => 'Действующая организация',
            'address' => '690920, Приморский край, Г.О. ВЛАДИВОСТОКСКИЙ, ОСТРОВ РУССКИЙ, П ВОЕВОДА, Д. 20, КОМ. 3.9',
            'region_id' => 1,
            'account_id' => 16,
            'tax_inspection' => 'Межрайонная инспекция Федеральной налоговой службы № 14 по Приморскому краю',
            'short_description' => 'this is short description',
            'website' => 'http://fakewebsite.com',
            'description' => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure? On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee',
            // 'cover_image_path' => 'https://marketplace.canva.com/EAFB2eB7C3o/1/0/1600w/canva-yellow-and-turquoise-vintage-rainbow-desktop-wallpaper-Y4mYj0d-9S8.jpg',
            // 'logo_image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6d/Volkswagen_logo_2019.svg/2048px-Volkswagen_logo_2019.svg.png',
        ]);

        Company::create([
            'type_short' => 'ООО',
            'type_full' => 'Общество с ограниченной ответственностью',
            'name' => 'АТЛАС',
            'name_full' => 'АТЛАС',
            'inn' => '7604392829',
            'kpp' => '760401001',
            'ogrn' => '1237600005752',
            'ogrn_date' => '1686096000000',
            'okved' => '69.20',
            'okved_text' => 'Деятельность по оказанию услуг в области бухгалтерского учета, по проведению финансового аудита, по налоговому консультированию',
            'manager_name' => 'Береснева Нина Михайловна',
            'manager_position' => 'ДИРЕКТОР',
            'okato' => '78401373000',
            'oktmo' => '78701000001',
            'okfs' => '16',
            'okogu' => '4210014',
            'okpo' => '52166247',
            'type_capital' => 'УСТАВНЫЙ КАПИТАЛ',
            'sum_capital' => '200000',
            'status' => 'ACTIVE',
            'status_text' => 'Действующая организация',
            'address' => 'г Ярославль, ул Мамонтова, д 8, кв 17',
            'region_id' => 1,
            'account_id' => 17,
            'tax_inspection' => 'Межрайонная инспекция Федеральной налоговой службы №5 по Ярославской области',
            'short_description' => 'this is short description',
            'website' => 'http://fakewebsite.com',
            'description' => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure? On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee',
            // 'cover_image_path' => 'https://marketplace.canva.com/EAFB2eB7C3o/1/0/1600w/canva-yellow-and-turquoise-vintage-rainbow-desktop-wallpaper-Y4mYj0d-9S8.jpg',
            // 'logo_image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6d/Volkswagen_logo_2019.svg/2048px-Volkswagen_logo_2019.svg.png',
        ]);

        Company::create([
            'type_short' => 'ООО',
            'type_full' => 'Общество с ограниченной ответственностью',
            'name' => 'ХУЯГТ-ОЮУ',
            'name_full' => 'ХУЯГТ-ОЮУ',
            'inn' => '0326567370',
            'kpp' => '032601001',
            'ogrn' => '1190327005043',
            'ogrn_date' => '1554854400000',
            'okved' => '73.20',
            'okved_text' => 'Исследование конъюнктуры рынка и изучение общественного мнения',
            'manager_name' => 'Хуягбаатар Энхчимэг',
            'manager_position' => 'ГЕНЕРАЛЬНЫЙ ДИРЕКТОР',
            'okato' => '81401365000',
            'oktmo' => '81701000001',
            'okfs' => '24',
            'okogu' => '4210011',
            'okpo' => '38643154',
            'type_capital' => 'УСТАВНЫЙ КАПИТАЛ',
            'sum_capital' => '15000',
            'status' => 'ACTIVE',
            'status_text' => 'Действующая организация',
            'address' => '670010, Республика Бурятия, Г. УЛАН-УДЭ, УЛ. ГАГАРИНА, Д. 37 А, ОФИС 12, РАБОЧЕЕ МЕСТО 8',
            'region_id' => 1,
            'account_id' => 18,
            'tax_inspection' => 'Управление Федеральной налоговой службы по Республике Бурятия',
            'short_description' => 'this is short description',
            'website' => 'http://fakewebsite.com',
            'description' => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure? On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee',
            // 'cover_image_path' => 'https://marketplace.canva.com/EAFB2eB7C3o/1/0/1600w/canva-yellow-and-turquoise-vintage-rainbow-desktop-wallpaper-Y4mYj0d-9S8.jpg',
            // 'logo_image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6d/Volkswagen_logo_2019.svg/2048px-Volkswagen_logo_2019.svg.png',
        ]);

        Company::create([
            'type_short' => 'ООО',
            'type_full' => 'Общество с ограниченной ответственностью',
            'name' => 'ОРГИЛ-ХАН',
            'name_full' => 'ОРГИЛ-ХАН',
            'inn' => '0326577756',
            'kpp' => '032601001',
            'ogrn' => '1200300006422',
            'ogrn_date' => '1590451200000',
            'okved' => '73.20',
            'okved_text' => 'Исследование конъюнктуры рынка и изучение общественного мнения',
            'manager_name' => 'Хуягбаатар Ариунболор',
            'manager_position' => 'ГЕНЕРАЛЬНЫЙ ДИРЕКТОР',
            'okato' => '81401365000',
            'oktmo' => '81701000001',
            'okfs' => '24',
            'okogu' => '4210011',
            'okpo' => '44298182',
            'type_capital' => 'УСТАВНЫЙ КАПИТАЛ',
            'sum_capital' => '10000',
            'status' => 'ACTIVE',
            'status_text' => 'Действующая организация',
            'address' => 'г Улан-Удэ, ул Гагарина, д 37А, офис 59/6',
            'region_id' => 1,
            'account_id' => 19,
            'tax_inspection' => 'Управление Федеральной налоговой службы по Республике Бурятия',
            'short_description' => 'this is short description',
            'website' => 'http://fakewebsite.com',
            'description' => 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure? On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee',
            // 'cover_image_path' => 'https://marketplace.canva.com/EAFB2eB7C3o/1/0/1600w/canva-yellow-and-turquoise-vintage-rainbow-desktop-wallpaper-Y4mYj0d-9S8.jpg',
            // 'logo_image_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6d/Volkswagen_logo_2019.svg/2048px-Volkswagen_logo_2019.svg.png',
        ]);
        $folder_files = 'uploads/company/files';
        CompanyMediaFile::create([
            'media_file_id' => $this->generateImage($folder_files . '/1'),
            'company_id' => 1
        ]);
        CompanyMediaFile::create([
            'media_file_id' => $this->generateImage($folder_files . '/1'),
            'company_id' => 1
        ]);
        CompanyMediaFile::create([
            'media_file_id' => $this->generateImage($folder_files . '/1'),
            'company_id' => 1
        ]);
        CompanyMediaFile::create([
            'media_file_id' => $this->generateImage($folder_files . '/1'),
            'company_id' => 1
        ]);

        CompanyMediaFile::create([
            'media_file_id' => $this->generateImage($folder_files . '/2'),
            'company_id' => 2
        ]);

        CompanyMediaFile::create([
            'media_file_id' => $this->generateImage($folder_files . '/2'),
            'company_id' => 2
        ]);


    }

    public function generateRandomHexColor()
    {
        $characters = '0123456789ABCDEF';
        $color = '';

        for ($i = 0; $i < 6; $i++) {
            $color .= $characters[random_int(0, 15)];
        }

        return $color;
    }

    public function generateImage($folder_name)
    {
        $response = Http::get("https://placehold.jp/" . $this->generateRandomHexColor() . "/ffffff/150x150.png");

        if ($response->successful()) {
            $imageContent = $response->body();
            $fileName = Str::uuid()->toString() . '.png';

            $storagePath = storage_path('app/public/' . $folder_name);
            if (!is_dir($storagePath)) {
                mkdir($storagePath, 0777, true);
            }
            $filePath = $storagePath . '/' . $fileName;
            file_put_contents($filePath, $imageContent);

            $fileSize = strlen($imageContent);
            $mimeType = finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $imageContent);

            $file_uploaded = MediaFile::create([
                'file_name' => $fileName,
                'file_path' => $folder_name . '/' . $fileName,
                'file_type' => $mimeType,
                'file_size' => $fileSize,
            ]);

            return $file_uploaded->id;
        }
    }
}
