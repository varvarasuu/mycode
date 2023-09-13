<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Metro;

class MetroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "8",
                "line_name" => "Калининская",
                "line_color" => "FFCD1C",
                "station_id" => "8.189",
                "station_name" => "Новокосино",
                "lat" => "55.745113",
                "lng" => "37.864052"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "8",
                "line_name" => "Калининская",
                "line_color" => "FFCD1C",
                "station_id" => "8.88",
                "station_name" => "Новогиреево",
                "lat" => "55.752237",
                "lng" => "37.814587"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "8",
                "line_name" => "Калининская",
                "line_color" => "FFCD1C",
                "station_id" => "8.107",
                "station_name" => "Перово",
                "lat" => "55.75098",
                "lng" => "37.78422"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "8",
                "line_name" => "Калининская",
                "line_color" => "FFCD1C",
                "station_id" => "8.158",
                "station_name" => "Шоссе Энтузиастов",
                "lat" => "55.75809",
                "lng" => "37.751703"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "8",
                "line_name" => "Калининская",
                "line_color" => "FFCD1C",
                "station_id" => "8.1",
                "station_name" => "Авиамоторная",
                "lat" => "55.751933",
                "lng" => "37.717444"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "8",
                "line_name" => "Калининская",
                "line_color" => "FFCD1C",
                "station_id" => "8.112",
                "station_name" => "Площадь Ильича",
                "lat" => "55.747115",
                "lng" => "37.680726"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "8",
                "line_name" => "Калининская",
                "line_color" => "FFCD1C",
                "station_id" => "8.78",
                "station_name" => "Марксистская",
                "lat" => "55.740746",
                "lng" => "37.65604"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "8",
                "line_name" => "Калининская",
                "line_color" => "FFCD1C",
                "station_id" => "8.91",
                "station_name" => "Третьяковская",
                "lat" => "55.741125",
                "lng" => "37.626142"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.558",
                "station_name" => "Ховрино",
                "lat" => "55.8777",
                "lng" => "37.4877"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.674",
                "station_name" => "Беломорская",
                "lat" => "55.8651",
                "lng" => "37.4764"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.125",
                "station_name" => "Речной вокзал",
                "lat" => "55.854152",
                "lng" => "37.476728"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.29",
                "station_name" => "Водный стадион",
                "lat" => "55.838978",
                "lng" => "37.487515"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.30",
                "station_name" => "Войковская",
                "lat" => "55.818923",
                "lng" => "37.497791"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.133",
                "station_name" => "Сокол",
                "lat" => "55.805564",
                "lng" => "37.515245"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.12",
                "station_name" => "Аэропорт",
                "lat" => "55.800441",
                "lng" => "37.530477"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.34",
                "station_name" => "Динамо",
                "lat" => "55.789704",
                "lng" => "37.558212"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.19",
                "station_name" => "Белорусская",
                "lat" => "55.777439",
                "lng" => "37.582107"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.80",
                "station_name" => "Маяковская",
                "lat" => "55.769808",
                "lng" => "37.596192"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.122",
                "station_name" => "Тверская",
                "lat" => "55.765343",
                "lng" => "37.603918"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.99",
                "station_name" => "Театральная",
                "lat" => "55.758808",
                "lng" => "37.61768"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.89",
                "station_name" => "Новокузнецкая",
                "lat" => "55.742391",
                "lng" => "37.62928"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.101",
                "station_name" => "Павелецкая",
                "lat" => "55.729741",
                "lng" => "37.638693"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.2",
                "station_name" => "Автозаводская",
                "lat" => "55.706634",
                "lng" => "37.657008"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.512",
                "station_name" => "Технопарк",
                "lat" => "55.695",
                "lng" => "37.664167"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.53",
                "station_name" => "Коломенская",
                "lat" => "55.677423",
                "lng" => "37.663719"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.45",
                "station_name" => "Каширская",
                "lat" => "55.655745",
                "lng" => "37.649683"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.42",
                "station_name" => "Кантемировская",
                "lat" => "55.636107",
                "lng" => "37.656218"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.153",
                "station_name" => "Царицыно",
                "lat" => "55.620982",
                "lng" => "37.669612"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.96",
                "station_name" => "Орехово",
                "lat" => "55.61269",
                "lng" => "37.695214"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.38",
                "station_name" => "Домодедовская",
                "lat" => "55.610131",
                "lng" => "37.717111"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.57",
                "station_name" => "Красногвардейская",
                "lat" => "55.614075",
                "lng" => "37.742697"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "2",
                "line_name" => "Замоскворецкая",
                "line_color" => "4FB04F",
                "station_id" => "2.257",
                "station_name" => "Алма-Атинская",
                "lat" => "55.63349",
                "lng" => "37.765678"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.81",
                "station_name" => "Медведково",
                "lat" => "55.888103",
                "lng" => "37.661562"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.13",
                "station_name" => "Бабушкинская",
                "lat" => "55.870641",
                "lng" => "37.664341"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.129",
                "station_name" => "Свиблово",
                "lat" => "55.855558",
                "lng" => "37.653379"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.24",
                "station_name" => "Ботанический сад",
                "lat" => "55.844597",
                "lng" => "37.637811"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.27",
                "station_name" => "ВДНХ",
                "lat" => "55.819626",
                "lng" => "37.640751"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.8",
                "station_name" => "Алексеевская",
                "lat" => "55.807794",
                "lng" => "37.638699"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.126",
                "station_name" => "Рижская",
                "lat" => "55.792494",
                "lng" => "37.636114"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.120",
                "station_name" => "Проспект Мира",
                "lat" => "55.781827",
                "lng" => "37.633199"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.137",
                "station_name" => "Сухаревская",
                "lat" => "55.772315",
                "lng" => "37.63285"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.144",
                "station_name" => "Тургеневская",
                "lat" => "55.765371",
                "lng" => "37.636732"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.50",
                "station_name" => "Китай-город",
                "lat" => "55.756498",
                "lng" => "37.631326"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.90",
                "station_name" => "Третьяковская",
                "lat" => "55.74073",
                "lng" => "37.625624"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.94",
                "station_name" => "Октябрьская",
                "lat" => "55.731232",
                "lng" => "37.612851"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.157",
                "station_name" => "Шаболовская",
                "lat" => "55.718828",
                "lng" => "37.607892"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.74",
                "station_name" => "Ленинский проспект",
                "lat" => "55.70678",
                "lng" => "37.58499"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.3",
                "station_name" => "Академическая",
                "lat" => "55.687147",
                "lng" => "37.5723"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.121",
                "station_name" => "Профсоюзная",
                "lat" => "55.677671",
                "lng" => "37.562595"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.92",
                "station_name" => "Новые Черемушки",
                "lat" => "55.670077",
                "lng" => "37.554493"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.41",
                "station_name" => "Калужская",
                "lat" => "55.656682",
                "lng" => "37.540075"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.21",
                "station_name" => "Беляево",
                "lat" => "55.642357",
                "lng" => "37.526115"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.56",
                "station_name" => "Коньково",
                "lat" => "55.631857",
                "lng" => "37.519156"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.140",
                "station_name" => "Теплый Стан",
                "lat" => "55.61873",
                "lng" => "37.505912"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.164",
                "station_name" => "Ясенево",
                "lat" => "55.606182",
                "lng" => "37.5334"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "6",
                "line_name" => "Калужско-Рижская",
                "line_color" => "F07E24",
                "station_id" => "6.23",
                "station_name" => "Новоясеневская",
                "lat" => "55.601947",
                "lng" => "37.553017"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.148",
                "station_name" => "Бульвар Рокоссовского",
                "lat" => "55.814916",
                "lng" => "37.732227"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.155",
                "station_name" => "Черкизовская",
                "lat" => "55.802787",
                "lng" => "37.744863"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.117",
                "station_name" => "Преображенская площадь",
                "lat" => "55.796322",
                "lng" => "37.713582"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.134",
                "station_name" => "Сокольники",
                "lat" => "55.789282",
                "lng" => "37.679895"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.60",
                "station_name" => "Красносельская",
                "lat" => "55.780014",
                "lng" => "37.666097"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.54",
                "station_name" => "Комсомольская",
                "lat" => "55.774072",
                "lng" => "37.654565"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.61",
                "station_name" => "Красные ворота",
                "lat" => "55.768307",
                "lng" => "37.6478"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.143",
                "station_name" => "Чистые пруды",
                "lat" => "55.76499",
                "lng" => "37.638293"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.66",
                "station_name" => "Лубянка",
                "lat" => "55.759889",
                "lng" => "37.625336"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.98",
                "station_name" => "Охотный ряд",
                "lat" => "55.757228",
                "lng" => "37.615078"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.4",
                "station_name" => "Библиотека им.Ленина",
                "lat" => "55.752123",
                "lng" => "37.610388"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.64",
                "station_name" => "Кропоткинская",
                "lat" => "55.745297",
                "lng" => "37.604217"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.103",
                "station_name" => "Парк культуры",
                "lat" => "55.736163",
                "lng" => "37.595027"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.152",
                "station_name" => "Фрунзенская",
                "lat" => "55.727462",
                "lng" => "37.58022"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.135",
                "station_name" => "Спортивная",
                "lat" => "55.722388",
                "lng" => "37.562041"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.165",
                "station_name" => "Воробьевы горы",
                "lat" => "55.709169",
                "lng" => "37.557293"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.149",
                "station_name" => "Университет",
                "lat" => "55.69329",
                "lng" => "37.534511"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.118",
                "station_name" => "Проспект Вернадского",
                "lat" => "55.676549",
                "lng" => "37.504584"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.162",
                "station_name" => "Юго-Западная",
                "lat" => "55.663146",
                "lng" => "37.482852"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.505",
                "station_name" => "Тропарево",
                "lat" => "55.6459",
                "lng" => "37.4725"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.513",
                "station_name" => "Румянцево",
                "lat" => "55.633",
                "lng" => "37.4419"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.514",
                "station_name" => "Саларьево",
                "lat" => "55.6227",
                "lng" => "37.424"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.678",
                "station_name" => "Филатов луг",
                "lat" => "55.5997",
                "lng" => "37.4075"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.679",
                "station_name" => "Прокшино",
                "lat" => "55.5813",
                "lng" => "37.4425"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.680",
                "station_name" => "Ольховая",
                "lat" => "55.5692",
                "lng" => "37.4589"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "1",
                "line_name" => "Сокольническая",
                "line_color" => "E42313",
                "station_id" => "1.681",
                "station_name" => "Коммунарка",
                "lat" => "55.559765",
                "lng" => "37.468716"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.159",
                "station_name" => "Щелковская",
                "lat" => "55.809962",
                "lng" => "37.798261"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.106",
                "station_name" => "Первомайская",
                "lat" => "55.794376",
                "lng" => "37.799364"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.40",
                "station_name" => "Измайловская",
                "lat" => "55.787713",
                "lng" => "37.779896"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.105",
                "station_name" => "Партизанская",
                "lat" => "55.788401",
                "lng" => "37.74882"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.130",
                "station_name" => "Семеновская",
                "lat" => "55.783096",
                "lng" => "37.719289"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.161",
                "station_name" => "Электрозаводская",
                "lat" => "55.782057",
                "lng" => "37.7053"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.17",
                "station_name" => "Бауманская",
                "lat" => "55.772405",
                "lng" => "37.67904"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.70",
                "station_name" => "Курская",
                "lat" => "55.758564",
                "lng" => "37.659039"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.100",
                "station_name" => "Площадь Революции",
                "lat" => "55.756741",
                "lng" => "37.62236"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.5",
                "station_name" => "Арбатская",
                "lat" => "55.752312",
                "lng" => "37.60349"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.131",
                "station_name" => "Смоленская",
                "lat" => "55.747713",
                "lng" => "37.583802"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.47",
                "station_name" => "Киевская",
                "lat" => "55.743117",
                "lng" => "37.564132"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.173",
                "station_name" => "Парк Победы",
                "lat" => "55.735679",
                "lng" => "37.516865"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.176",
                "station_name" => "Славянский бульвар",
                "lat" => "55.729542",
                "lng" => "37.470973"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.69",
                "station_name" => "Кунцевская",
                "lat" => "55.730673",
                "lng" => "37.446522"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.84",
                "station_name" => "Молодежная",
                "lat" => "55.741375",
                "lng" => "37.415627"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.65",
                "station_name" => "Крылатское",
                "lat" => "55.756842",
                "lng" => "37.408139"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.174",
                "station_name" => "Строгино",
                "lat" => "55.803831",
                "lng" => "37.402405"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.181",
                "station_name" => "Мякинино",
                "lat" => "55.823342",
                "lng" => "37.385214"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.182",
                "station_name" => "Волоколамская",
                "lat" => "55.835154",
                "lng" => "37.382453"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.183",
                "station_name" => "Митино",
                "lat" => "55.846098",
                "lng" => "37.36122"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "3",
                "line_name" => "Арбатско-Покровская",
                "line_color" => "0072BA",
                "station_id" => "3.463",
                "station_name" => "Пятницкое шоссе",
                "lat" => "55.853634",
                "lng" => "37.353108"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "4",
                "line_name" => "Филевская",
                "line_color" => "1EBCEF",
                "station_id" => "4.471",
                "station_name" => "Кунцевская",
                "lat" => "55.730815",
                "lng" => "37.446754"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "4",
                "line_name" => "Филевская",
                "line_color" => "1EBCEF",
                "station_id" => "4.110",
                "station_name" => "Пионерская",
                "lat" => "55.736027",
                "lng" => "37.466728"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "4",
                "line_name" => "Филевская",
                "line_color" => "1EBCEF",
                "station_id" => "4.150",
                "station_name" => "Филевский парк",
                "lat" => "55.739665",
                "lng" => "37.483902"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "4",
                "line_name" => "Филевская",
                "line_color" => "1EBCEF",
                "station_id" => "4.14",
                "station_name" => "Багратионовская",
                "lat" => "55.743544",
                "lng" => "37.497042"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "4",
                "line_name" => "Филевская",
                "line_color" => "1EBCEF",
                "station_id" => "4.151",
                "station_name" => "Фили",
                "lat" => "55.746763",
                "lng" => "37.514035"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "4",
                "line_name" => "Филевская",
                "line_color" => "1EBCEF",
                "station_id" => "4.73",
                "station_name" => "Кутузовская",
                "lat" => "55.740544",
                "lng" => "37.5341"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "4",
                "line_name" => "Филевская",
                "line_color" => "1EBCEF",
                "station_id" => "4.136",
                "station_name" => "Студенческая",
                "lat" => "55.738761",
                "lng" => "37.54842"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "4",
                "line_name" => "Филевская",
                "line_color" => "1EBCEF",
                "station_id" => "4.48",
                "station_name" => "Киевская",
                "lat" => "55.743168",
                "lng" => "37.565425"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "4",
                "line_name" => "Филевская",
                "line_color" => "1EBCEF",
                "station_id" => "4.132",
                "station_name" => "Смоленская",
                "lat" => "55.749083",
                "lng" => "37.582173"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "4",
                "line_name" => "Филевская",
                "line_color" => "1EBCEF",
                "station_id" => "4.11",
                "station_name" => "Арбатская",
                "lat" => "55.752122",
                "lng" => "37.601553"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "4",
                "line_name" => "Филевская",
                "line_color" => "1EBCEF",
                "station_id" => "4.6",
                "station_name" => "Александровский сад",
                "lat" => "55.752255",
                "lng" => "37.608775"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "4",
                "line_name" => "Филевская",
                "line_color" => "1EBCEF",
                "station_id" => "4.172",
                "station_name" => "Выставочная",
                "lat" => "55.750243",
                "lng" => "37.542641"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "4",
                "line_name" => "Филевская",
                "line_color" => "1EBCEF",
                "station_id" => "4.179",
                "station_name" => "Международная",
                "lat" => "55.748324",
                "lng" => "37.533282"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.9",
                "station_name" => "Алтуфьево",
                "lat" => "55.899034",
                "lng" => "37.586473"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.22",
                "station_name" => "Бибирево",
                "lat" => "55.883868",
                "lng" => "37.603011"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.97",
                "station_name" => "Отрадное",
                "lat" => "55.864273",
                "lng" => "37.605066"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.28",
                "station_name" => "Владыкино",
                "lat" => "55.848236",
                "lng" => "37.590451"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.108",
                "station_name" => "Петровско-Разумовская",
                "lat" => "55.836565",
                "lng" => "37.575512"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.141",
                "station_name" => "Тимирязевская",
                "lat" => "55.81866",
                "lng" => "37.574498"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.35",
                "station_name" => "Дмитровская",
                "lat" => "55.808056",
                "lng" => "37.581734"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.128",
                "station_name" => "Савёловская",
                "lat" => "55.794054",
                "lng" => "37.587163"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.83",
                "station_name" => "Менделеевская",
                "lat" => "55.781999",
                "lng" => "37.599141"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.154",
                "station_name" => "Цветной бульвар",
                "lat" => "55.771653",
                "lng" => "37.620466"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.123",
                "station_name" => "Чеховская",
                "lat" => "55.765747",
                "lng" => "37.608493"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.7",
                "station_name" => "Боровицкая",
                "lat" => "55.750399",
                "lng" => "37.60934"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.115",
                "station_name" => "Полянка",
                "lat" => "55.736795",
                "lng" => "37.618594"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.37",
                "station_name" => "Серпуховская",
                "lat" => "55.726548",
                "lng" => "37.624792"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.142",
                "station_name" => "Тульская",
                "lat" => "55.70961",
                "lng" => "37.622569"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.85",
                "station_name" => "Нагатинская",
                "lat" => "55.682099",
                "lng" => "37.620917"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.86",
                "station_name" => "Нагорная",
                "lat" => "55.672962",
                "lng" => "37.610397"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.87",
                "station_name" => "Нахимовский проспект",
                "lat" => "55.662379",
                "lng" => "37.605274"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.43",
                "station_name" => "Севастопольская",
                "lat" => "55.651451",
                "lng" => "37.59809"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.156",
                "station_name" => "Чертановская",
                "lat" => "55.640538",
                "lng" => "37.606065"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.163",
                "station_name" => "Южная",
                "lat" => "55.622436",
                "lng" => "37.609047"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.116",
                "station_name" => "Пражская",
                "lat" => "55.610962",
                "lng" => "37.602386"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.147",
                "station_name" => "Улица Академика Янгеля",
                "lat" => "55.596753",
                "lng" => "37.601498"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.10",
                "station_name" => "Аннино",
                "lat" => "55.583477",
                "lng" => "37.596999"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "9",
                "line_name" => "Серпуховско-Тимирязевская",
                "line_color" => "ADACAC",
                "station_id" => "9.170",
                "station_name" => "Бульвар Дмитрия Донского",
                "lat" => "55.568201",
                "lng" => "37.576856"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.111",
                "station_name" => "Планерная",
                "lat" => "55.859676",
                "lng" => "37.436808"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.138",
                "station_name" => "Сходненская",
                "lat" => "55.84926",
                "lng" => "37.44076"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.145",
                "station_name" => "Тушинская",
                "lat" => "55.825479",
                "lng" => "37.437024"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.507",
                "station_name" => "Спартак",
                "lat" => "55.8182",
                "lng" => "37.4352"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.160",
                "station_name" => "Щукинская",
                "lat" => "55.8094",
                "lng" => "37.463241"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.95",
                "station_name" => "Октябрьское поле",
                "lat" => "55.793581",
                "lng" => "37.493317"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.114",
                "station_name" => "Полежаевская",
                "lat" => "55.777201",
                "lng" => "37.517895"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.18",
                "station_name" => "Беговая",
                "lat" => "55.773505",
                "lng" => "37.545518"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.146",
                "station_name" => "Улица 1905 года",
                "lat" => "55.763944",
                "lng" => "37.562271"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.16",
                "station_name" => "Баррикадная",
                "lat" => "55.760793",
                "lng" => "37.581242"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.124",
                "station_name" => "Пушкинская",
                "lat" => "55.765607",
                "lng" => "37.604356"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.67",
                "station_name" => "Кузнецкий мост",
                "lat" => "55.761498",
                "lng" => "37.624423"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.51",
                "station_name" => "Китай-город",
                "lat" => "55.75436",
                "lng" => "37.633877"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.77",
                "station_name" => "Таганская",
                "lat" => "55.739502",
                "lng" => "37.653605"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.62",
                "station_name" => "Пролетарская",
                "lat" => "55.731546",
                "lng" => "37.666917"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.31",
                "station_name" => "Волгоградский проспект",
                "lat" => "55.725546",
                "lng" => "37.685197"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.139",
                "station_name" => "Текстильщики",
                "lat" => "55.709211",
                "lng" => "37.732117"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.68",
                "station_name" => "Кузьминки",
                "lat" => "55.705493",
                "lng" => "37.763295"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.127",
                "station_name" => "Рязанский проспект",
                "lat" => "55.716139",
                "lng" => "37.792694"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.33",
                "station_name" => "Выхино",
                "lat" => "55.715983",
                "lng" => "37.816788"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.464",
                "station_name" => "Лермонтовский проспект",
                "lat" => "55.702036",
                "lng" => "37.851044"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.465",
                "station_name" => "Жулебино",
                "lat" => "55.684722",
                "lng" => "37.855833"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "7",
                "line_name" => "Таганско-Краснопресненская",
                "line_color" => "943E90",
                "station_id" => "7.508",
                "station_name" => "Котельники",
                "lat" => "55.6743",
                "lng" => "37.8582"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "5",
                "line_name" => "Кольцевая",
                "line_color" => "915133",
                "station_id" => "5.82",
                "station_name" => "Новослободская",
                "lat" => "55.779606",
                "lng" => "37.601252"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "5",
                "line_name" => "Кольцевая",
                "line_color" => "915133",
                "station_id" => "5.119",
                "station_name" => "Проспект Мира",
                "lat" => "55.779584",
                "lng" => "37.633646"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "5",
                "line_name" => "Кольцевая",
                "line_color" => "915133",
                "station_id" => "5.55",
                "station_name" => "Комсомольская",
                "lat" => "55.775672",
                "lng" => "37.654772"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "5",
                "line_name" => "Кольцевая",
                "line_color" => "915133",
                "station_id" => "5.71",
                "station_name" => "Курская",
                "lat" => "55.758631",
                "lng" => "37.661059"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "5",
                "line_name" => "Кольцевая",
                "line_color" => "915133",
                "station_id" => "5.76",
                "station_name" => "Таганская",
                "lat" => "55.742396",
                "lng" => "37.653334"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "5",
                "line_name" => "Кольцевая",
                "line_color" => "915133",
                "station_id" => "5.102",
                "station_name" => "Павелецкая",
                "lat" => "55.731414",
                "lng" => "37.636294"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "5",
                "line_name" => "Кольцевая",
                "line_color" => "915133",
                "station_id" => "5.36",
                "station_name" => "Добрынинская",
                "lat" => "55.728994",
                "lng" => "37.622533"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "5",
                "line_name" => "Кольцевая",
                "line_color" => "915133",
                "station_id" => "5.93",
                "station_name" => "Октябрьская",
                "lat" => "55.729264",
                "lng" => "37.611049"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "5",
                "line_name" => "Кольцевая",
                "line_color" => "915133",
                "station_id" => "5.104",
                "station_name" => "Парк культуры",
                "lat" => "55.735221",
                "lng" => "37.593095"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "5",
                "line_name" => "Кольцевая",
                "line_color" => "915133",
                "station_id" => "5.49",
                "station_name" => "Киевская",
                "lat" => "55.74361",
                "lng" => "37.56735"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "5",
                "line_name" => "Кольцевая",
                "line_color" => "915133",
                "station_id" => "5.58",
                "station_name" => "Краснопресненская",
                "lat" => "55.760378",
                "lng" => "37.577114"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "5",
                "line_name" => "Кольцевая",
                "line_color" => "915133",
                "station_id" => "5.20",
                "station_name" => "Белорусская",
                "lat" => "55.775179",
                "lng" => "37.582303"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.597",
                "station_name" => "Селигерская",
                "lat" => "55.86483",
                "lng" => "37.55005"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.598",
                "station_name" => "Верхние Лихоборы",
                "lat" => "55.85566",
                "lng" => "37.56282"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.596",
                "station_name" => "Окружная",
                "lat" => "55.848889",
                "lng" => "37.571111"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.548",
                "station_name" => "Петровско-Разумовская",
                "lat" => "55.836667",
                "lng" => "37.575556"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.547",
                "station_name" => "Фонвизинская",
                "lat" => "55.822778",
                "lng" => "37.588056"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.546",
                "station_name" => "Бутырская ",
                "lat" => "55.813333",
                "lng" => "37.602778"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.185",
                "station_name" => "Марьина Роща",
                "lat" => "55.793723",
                "lng" => "37.61618"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.184",
                "station_name" => "Достоевская",
                "lat" => "55.781667",
                "lng" => "37.613889"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.177",
                "station_name" => "Трубная",
                "lat" => "55.76771",
                "lng" => "37.621926"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.175",
                "station_name" => "Сретенский бульвар",
                "lat" => "55.766106",
                "lng" => "37.635688"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.72",
                "station_name" => "Чкаловская",
                "lat" => "55.755951",
                "lng" => "37.659293"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.113",
                "station_name" => "Римская",
                "lat" => "55.747027",
                "lng" => "37.679996"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.63",
                "station_name" => "Крестьянская застава",
                "lat" => "55.732278",
                "lng" => "37.665325"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.39",
                "station_name" => "Дубровка",
                "lat" => "55.71807",
                "lng" => "37.676259"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.52",
                "station_name" => "Кожуховская",
                "lat" => "55.706156",
                "lng" => "37.68544"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.109",
                "station_name" => "Печатники",
                "lat" => "55.692921",
                "lng" => "37.728338"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.32",
                "station_name" => "Волжская",
                "lat" => "55.690446",
                "lng" => "37.754314"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.75",
                "station_name" => "Люблино",
                "lat" => "55.676596",
                "lng" => "37.761639"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.25",
                "station_name" => "Братиславская",
                "lat" => "55.658817",
                "lng" => "37.748415"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.79",
                "station_name" => "Марьино",
                "lat" => "55.649158",
                "lng" => "37.743844"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.187",
                "station_name" => "Борисово",
                "lat" => "55.6325",
                "lng" => "37.743333"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.188",
                "station_name" => "Шипиловская",
                "lat" => "55.621667",
                "lng" => "37.743611"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "10",
                "line_name" => "Люблинско-Дмитровская",
                "line_color" => "BED12C",
                "station_id" => "10.186",
                "station_name" => "Зябликово",
                "lat" => "55.611944",
                "lng" => "37.745278"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "11",
                "line_name" => "Каховская",
                "line_color" => "88CDCF",
                "station_id" => "11.46",
                "station_name" => "Каширская",
                "lat" => "55.654327",
                "lng" => "37.647705"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "11",
                "line_name" => "Каховская",
                "line_color" => "88CDCF",
                "station_id" => "11.26",
                "station_name" => "Варшавская",
                "lat" => "55.653294",
                "lng" => "37.619522"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "11",
                "line_name" => "Каховская",
                "line_color" => "88CDCF",
                "station_id" => "11.44",
                "station_name" => "Каховская",
                "lat" => "55.652923",
                "lng" => "37.596573"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "12",
                "line_name" => "Бутовская",
                "line_color" => "BAC8E8",
                "station_id" => "12.167",
                "station_name" => "Бунинская аллея",
                "lat" => "55.537977",
                "lng" => "37.515899"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "12",
                "line_name" => "Бутовская",
                "line_color" => "BAC8E8",
                "station_id" => "12.168",
                "station_name" => "Улица Горчакова",
                "lat" => "55.542281",
                "lng" => "37.532063"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "12",
                "line_name" => "Бутовская",
                "line_color" => "BAC8E8",
                "station_id" => "12.169",
                "station_name" => "Бульвар Адмирала Ушакова",
                "lat" => "55.545207",
                "lng" => "37.542329"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "12",
                "line_name" => "Бутовская",
                "line_color" => "BAC8E8",
                "station_id" => "12.166",
                "station_name" => "Улица Скобелевская",
                "lat" => "55.548103",
                "lng" => "37.552721"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "12",
                "line_name" => "Бутовская",
                "line_color" => "BAC8E8",
                "station_id" => "12.171",
                "station_name" => "Улица Старокачаловская",
                "lat" => "55.569194",
                "lng" => "37.576074"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "12",
                "line_name" => "Бутовская",
                "line_color" => "BAC8E8",
                "station_id" => "12.466",
                "station_name" => "Лесопарковая",
                "lat" => "55.581656",
                "lng" => "37.577816"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "12",
                "line_name" => "Бутовская",
                "line_color" => "BAC8E8",
                "station_id" => "12.467",
                "station_name" => "Битцевский Парк",
                "lat" => "55.600066",
                "lng" => "37.556058"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "133",
                "line_name" => "Солнцевская",
                "line_color" => "FFCD1C",
                "station_id" => "133.468",
                "station_name" => "Деловой центр",
                "lat" => "55.7491",
                "lng" => "37.5395"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "133",
                "line_name" => "Солнцевская",
                "line_color" => "FFCD1C",
                "station_id" => "133.470",
                "station_name" => "Парк Победы",
                "lat" => "55.736478",
                "lng" => "37.514401"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "133",
                "line_name" => "Солнцевская",
                "line_color" => "FFCD1C",
                "station_id" => "133.555",
                "station_name" => "Минская",
                "lat" => "55.7232",
                "lng" => "37.5038"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "133",
                "line_name" => "Солнцевская",
                "line_color" => "FFCD1C",
                "station_id" => "133.556",
                "station_name" => "Ломоносовский проспект",
                "lat" => "55.7055",
                "lng" => "37.5225"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "133",
                "line_name" => "Солнцевская",
                "line_color" => "FFCD1C",
                "station_id" => "133.557",
                "station_name" => "Раменки",
                "lat" => "55.6961",
                "lng" => "37.505"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "133",
                "line_name" => "Солнцевская",
                "line_color" => "FFCD1C",
                "station_id" => "133.607",
                "station_name" => "Мичуринский проспект",
                "lat" => "55.6888",
                "lng" => "37.485"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "133",
                "line_name" => "Солнцевская",
                "line_color" => "FFCD1C",
                "station_id" => "133.608",
                "station_name" => "Озёрная",
                "lat" => "55.6698",
                "lng" => "37.4495"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "133",
                "line_name" => "Солнцевская",
                "line_color" => "FFCD1C",
                "station_id" => "133.609",
                "station_name" => "Говорово",
                "lat" => "55.6588",
                "lng" => "37.4174"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "133",
                "line_name" => "Солнцевская",
                "line_color" => "FFCD1C",
                "station_id" => "133.610",
                "station_name" => "Солнцево",
                "lat" => "55.649",
                "lng" => "37.3911"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "133",
                "line_name" => "Солнцевская",
                "line_color" => "FFCD1C",
                "station_id" => "133.611",
                "station_name" => "Боровское шоссе",
                "lat" => "55.647",
                "lng" => "37.3701"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "133",
                "line_name" => "Солнцевская",
                "line_color" => "FFCD1C",
                "station_id" => "133.612",
                "station_name" => "Новопеределкино",
                "lat" => "55.6385",
                "lng" => "37.3544"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "133",
                "line_name" => "Солнцевская",
                "line_color" => "FFCD1C",
                "station_id" => "133.613",
                "station_name" => "Рассказовка",
                "lat" => "55.6324",
                "lng" => "37.3328"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.515",
                "station_name" => "Окружная",
                "lat" => "55.848889",
                "lng" => "37.571111"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.516",
                "station_name" => "Владыкино",
                "lat" => "55.847222",
                "lng" => "37.591944"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.517",
                "station_name" => "Ботанический сад",
                "lat" => "55.845556",
                "lng" => "37.640278"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.518",
                "station_name" => "Ростокино",
                "lat" => "55.839444",
                "lng" => "37.667778"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.519",
                "station_name" => "Белокаменная",
                "lat" => "55.83",
                "lng" => "37.700556"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.520",
                "station_name" => "Бульвар Рокоссовского",
                "lat" => "55.817222",
                "lng" => "37.736944"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.521",
                "station_name" => "Локомотив",
                "lat" => "55.803219",
                "lng" => "37.745742"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.522",
                "station_name" => "Измайлово",
                "lat" => "55.788611",
                "lng" => "37.742778"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.523",
                "station_name" => "Соколиная Гора",
                "lat" => "55.77",
                "lng" => "37.745278"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.524",
                "station_name" => "Шоссе Энтузиастов",
                "lat" => "55.758633",
                "lng" => "37.748477"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.525",
                "station_name" => "Андроновка",
                "lat" => "55.741111",
                "lng" => "37.734444"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.526",
                "station_name" => "Нижегородская",
                "lat" => "55.732222",
                "lng" => "37.72825"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.527",
                "station_name" => "Новохохловская",
                "lat" => "55.723889",
                "lng" => "37.716111"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.528",
                "station_name" => "Угрешская",
                "lat" => "55.718333",
                "lng" => "37.697778"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.529",
                "station_name" => "Дубровка",
                "lat" => "55.71268",
                "lng" => "37.677775"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.530",
                "station_name" => "Автозаводская",
                "lat" => "55.70631",
                "lng" => "37.66314"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.531",
                "station_name" => "ЗИЛ",
                "lat" => "55.698333",
                "lng" => "37.648333"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.532",
                "station_name" => "Верхние Котлы",
                "lat" => "55.69",
                "lng" => "37.618889"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.533",
                "station_name" => "Крымская",
                "lat" => "55.690038",
                "lng" => "37.605"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.534",
                "station_name" => "Площадь Гагарина",
                "lat" => "55.706944",
                "lng" => "37.585833"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.535",
                "station_name" => "Лужники",
                "lat" => "55.720278",
                "lng" => "37.563056"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.536",
                "station_name" => "Кутузовская",
                "lat" => "55.740833",
                "lng" => "37.533333"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.537",
                "station_name" => "Деловой центр",
                "lat" => "55.747222",
                "lng" => "37.532222"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.538",
                "station_name" => "Шелепиха",
                "lat" => "55.7575",
                "lng" => "37.525556"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.539",
                "station_name" => "Хорошево",
                "lat" => "55.777222",
                "lng" => "37.507222"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.540",
                "station_name" => "Зорге",
                "lat" => "55.787778",
                "lng" => "37.504444"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.541",
                "station_name" => "Панфиловская",
                "lat" => "55.799167",
                "lng" => "37.498889"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.542",
                "station_name" => "Стрешнево",
                "lat" => "55.813611",
                "lng" => "37.486944"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.543",
                "station_name" => "Балтийская",
                "lat" => "55.825833",
                "lng" => "37.496111"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.544",
                "station_name" => "Коптево",
                "lat" => "55.839637",
                "lng" => "37.520037"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "95",
                "line_name" => "МЦК",
                "line_color" => "CC4C6E",
                "station_id" => "95.545",
                "station_name" => "Лихоборы",
                "lat" => "55.847222",
                "lng" => "37.551389"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "96",
                "line_name" => "Монорельс",
                "line_color" => "006DA8",
                "station_id" => "96.549",
                "station_name" => "Тимирязевская",
                "lat" => "55.819049",
                "lng" => "37.578882"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "96",
                "line_name" => "Монорельс",
                "line_color" => "006DA8",
                "station_id" => "96.550",
                "station_name" => "Улица Милашенкова",
                "lat" => "55.821876",
                "lng" => "37.591206"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "96",
                "line_name" => "Монорельс",
                "line_color" => "006DA8",
                "station_id" => "96.551",
                "station_name" => "Телецентр",
                "lat" => "55.821795",
                "lng" => "37.608975"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "96",
                "line_name" => "Монорельс",
                "line_color" => "006DA8",
                "station_id" => "96.552",
                "station_name" => "Улица Академика Королёва",
                "lat" => "55.821821",
                "lng" => "37.627167"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "96",
                "line_name" => "Монорельс",
                "line_color" => "006DA8",
                "station_id" => "96.553",
                "station_name" => "Выставочный центр",
                "lat" => "55.824086",
                "lng" => "37.638494"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "96",
                "line_name" => "Монорельс",
                "line_color" => "006DA8",
                "station_id" => "96.554",
                "station_name" => "Улица Сергея Эйзенштейна",
                "lat" => "55.829305",
                "lng" => "37.644997"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.813",
                "station_name" => "Мичуринский проспект",
                "lat" => "55.688333",
                "lng" => "37.485"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.814",
                "station_name" => "Проспект Вернадского",
                "lat" => "55.677778",
                "lng" => "37.505"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.815",
                "station_name" => "Новаторская",
                "lat" => "55.670833",
                "lng" => "37.52"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.816",
                "station_name" => "Воронцовская",
                "lat" => "55.658333",
                "lng" => "37.540833"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.817",
                "station_name" => "Зюзино",
                "lat" => "55.489722",
                "lng" => "37.572222"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.818",
                "station_name" => "Каховская",
                "lat" => "55.653056",
                "lng" => "37.598333"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.824",
                "station_name" => "Варшавская",
                "lat" => "55.653333",
                "lng" => "37.619444"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.832",
                "station_name" => "Каширская",
                "lat" => "55.655",
                "lng" => "37.648611"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.831",
                "station_name" => "Кленовый бульвар",
                "lat" => "55.674444",
                "lng" => "37.680833"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.830",
                "station_name" => "Нагатинский Затон",
                "lat" => "55.684444",
                "lng" => "37.703611"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.829",
                "station_name" => "Печатники",
                "lat" => "55.694722",
                "lng" => "37.7275"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.828",
                "station_name" => "Текстильщики",
                "lat" => "55.708333",
                "lng" => "37.728333"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.827",
                "station_name" => "Нижегородская",
                "lat" => "55.7325",
                "lng" => "37.728611"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.826",
                "station_name" => "Авиамоторная",
                "lat" => "55.753056",
                "lng" => "37.718611"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.825",
                "station_name" => "Лефортово",
                "lat" => "55.764444",
                "lng" => "37.702778"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.803",
                "station_name" => "Электрозаводская",
                "lat" => "55.782057",
                "lng" => "37.7053"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.823",
                "station_name" => "Сокольники",
                "lat" => "55.791111",
                "lng" => "37.678889"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.822",
                "station_name" => "Рижская",
                "lat" => "55.792222",
                "lng" => "37.633889"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.821",
                "station_name" => "Марьина Роща",
                "lat" => "55.798333",
                "lng" => "37.617222"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.685",
                "station_name" => "Савёловская",
                "lat" => "55.794054",
                "lng" => "37.587163"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.599",
                "station_name" => "Петровский парк",
                "lat" => "55.79233",
                "lng" => "37.55952"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.600",
                "station_name" => "ЦСКА",
                "lat" => "55.78643",
                "lng" => "37.53502"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.601",
                "station_name" => "Хорошевская",
                "lat" => "55.77643",
                "lng" => "37.51981"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.602",
                "station_name" => "Шелепиха",
                "lat" => "55.75723",
                "lng" => "37.52571"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.603",
                "station_name" => "Деловой центр",
                "lat" => "55.7491",
                "lng" => "37.5395"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.806",
                "station_name" => "Народное Ополчение",
                "lat" => "55.775278",
                "lng" => "39.484444"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.805",
                "station_name" => "Мнёвники",
                "lat" => "55.761153",
                "lng" => "37.47139"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.809",
                "station_name" => "Терехово",
                "lat" => "55.749167",
                "lng" => "38.460556"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.810",
                "station_name" => "Кунцевская",
                "lat" => "55.730278",
                "lng" => "37.445833"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.811",
                "station_name" => "Давыдково",
                "lat" => "55.765278",
                "lng" => "37.451667"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "97",
                "line_name" => "Большая кольцевая линия",
                "line_color" => "88CDCF",
                "station_id" => "97.812",
                "station_name" => "Аминьевская",
                "lat" => "55.697222",
                "lng" => "37.464167"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "98",
                "line_name" => "Некрасовская",
                "line_color" => "CC0066",
                "station_id" => "98.675",
                "station_name" => "Косино",
                "lat" => "55.7026",
                "lng" => "37.8511"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "98",
                "line_name" => "Некрасовская",
                "line_color" => "CC0066",
                "station_id" => "98.676",
                "station_name" => "Улица Дмитриевского",
                "lat" => "55.7093",
                "lng" => "37.8792"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "98",
                "line_name" => "Некрасовская",
                "line_color" => "CC0066",
                "station_id" => "98.677",
                "station_name" => "Лухмановская",
                "lat" => "55.7078",
                "lng" => "37.9004"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "98",
                "line_name" => "Некрасовская",
                "line_color" => "CC0066",
                "station_id" => "98.641",
                "station_name" => "Некрасовка",
                "lat" => "55.7029",
                "lng" => "37.9264"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "98",
                "line_name" => "Некрасовская",
                "line_color" => "CC0066",
                "station_id" => "98.762",
                "station_name" => "Юго-Восточная",
                "lat" => "55.71",
                "lng" => "37.82"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "98",
                "line_name" => "Некрасовская",
                "line_color" => "CC0066",
                "station_id" => "98.763",
                "station_name" => "Окская",
                "lat" => "55.72",
                "lng" => "37.77"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "98",
                "line_name" => "Некрасовская",
                "line_color" => "CC0066",
                "station_id" => "98.764",
                "station_name" => "Стахановская",
                "lat" => "55.73",
                "lng" => "37.76"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "98",
                "line_name" => "Некрасовская",
                "line_color" => "CC0066",
                "station_id" => "98.765",
                "station_name" => "Нижегородская",
                "lat" => "55.73",
                "lng" => "37.73"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "98",
                "line_name" => "Некрасовская",
                "line_color" => "CC0066",
                "station_id" => "98.800",
                "station_name" => "Лефортово",
                "lat" => "55.764444",
                "lng" => "37.702778"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "98",
                "line_name" => "Некрасовская",
                "line_color" => "CC0066",
                "station_id" => "98.802",
                "station_name" => "Электрозаводская",
                "lat" => "55.782057",
                "lng" => "37.7053"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "98",
                "line_name" => "Некрасовская",
                "line_color" => "CC0066",
                "station_id" => "98.804",
                "station_name" => "Авиамоторная",
                "lat" => "55.751933",
                "lng" => "37.717444"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.687",
                "station_name" => "Лобня",
                "lat" => "56.0048",
                "lng" => "37.29057"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.688",
                "station_name" => "Шереметьевская",
                "lat" => "55.983882",
                "lng" => "37.498752"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.689",
                "station_name" => "Хлебниково",
                "lat" => "55.970682",
                "lng" => "37.504638"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.690",
                "station_name" => "Водники",
                "lat" => "55.953419",
                "lng" => "37.511143"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.691",
                "station_name" => "Долгопрудная",
                "lat" => "55.938656",
                "lng" => "37.520542"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.692",
                "station_name" => "Новодачная",
                "lat" => "55.924459",
                "lng" => "37.527877"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.693",
                "station_name" => "Марк",
                "lat" => "55.904458",
                "lng" => "37.538242"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.694",
                "station_name" => "Лианозово",
                "lat" => "55.897316",
                "lng" => "37.553261"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.695",
                "station_name" => "Бескудниково",
                "lat" => "55.882713",
                "lng" => "37.567768"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.696",
                "station_name" => "Дегунино",
                "lat" => "55.86586",
                "lng" => "37.573235"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.697",
                "station_name" => "Окружная",
                "lat" => "55.848889",
                "lng" => "37.571111"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.698",
                "station_name" => "Тимирязевская",
                "lat" => "55.81866",
                "lng" => "37.574498"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.699",
                "station_name" => "Савёловская",
                "lat" => "55.793936",
                "lng" => "37.587038"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.700",
                "station_name" => "Белорусская",
                "lat" => "55.775179",
                "lng" => "37.582303"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.701",
                "station_name" => "Беговая",
                "lat" => "55.773505",
                "lng" => "37.545518"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.702",
                "station_name" => "Тестовская",
                "lat" => "55.754292",
                "lng" => "37.531551"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.703",
                "station_name" => "Фили",
                "lat" => "55.744263",
                "lng" => "37.514526"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.801",
                "station_name" => "Славянский бульвар",
                "lat" => "55.729722",
                "lng" => "37.470556"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.704",
                "station_name" => "Кунцевская",
                "lat" => "55.730554",
                "lng" => "37.445591"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.705",
                "station_name" => "Рабочий Посёлок",
                "lat" => "55.726957",
                "lng" => "37.415577"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.706",
                "station_name" => "Сетунь",
                "lat" => "55.723713",
                "lng" => "37.397259"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.707",
                "station_name" => "Немчиновка",
                "lat" => "55.715668",
                "lng" => "37.374611"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.708",
                "station_name" => "Сколково",
                "lat" => "55.666801",
                "lng" => "37.424618"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.709",
                "station_name" => "Баковка",
                "lat" => "55.682816",
                "lng" => "37.315205"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "131",
                "line_name" => "МЦД - 1",
                "line_color" => "F5A528",
                "station_id" => "131.710",
                "station_name" => "Одинцово",
                "lat" => "55.67798",
                "lng" => "37.27773"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.711",
                "station_name" => "Нахабино",
                "lat" => "55.841522",
                "lng" => "37.185204"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.712",
                "station_name" => "Аникеевка",
                "lat" => "55.832099",
                "lng" => "37.219829"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.713",
                "station_name" => "Опалиха",
                "lat" => "55.82333",
                "lng" => "37.246843"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.714",
                "station_name" => "Красногорская",
                "lat" => "55.814571",
                "lng" => "37.303337"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.715",
                "station_name" => "Павшино",
                "lat" => "55.815231",
                "lng" => "37.341461"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.716",
                "station_name" => "Пенягино",
                "lat" => "55.822539",
                "lng" => "37.361049"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.717",
                "station_name" => "Волоколамская",
                "lat" => "55.835154",
                "lng" => "37.382453"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.744",
                "station_name" => "Трикотажная",
                "lat" => "55.833137",
                "lng" => "37.398967"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.718",
                "station_name" => "Тушинская",
                "lat" => "55.825479",
                "lng" => "37.437024"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.719",
                "station_name" => "Покровское-Стрешнево",
                "lat" => "55.814247",
                "lng" => "37.47678"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.720",
                "station_name" => "Стрешнево",
                "lat" => "55.813611",
                "lng" => "37.486944"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.721",
                "station_name" => "Красный Балтиец",
                "lat" => "55.815514",
                "lng" => "37.526367"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.722",
                "station_name" => "Гражданская",
                "lat" => "55.805527",
                "lng" => "37.55315"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.723",
                "station_name" => "Дмитровская",
                "lat" => "55.808056",
                "lng" => "37.581734"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.724",
                "station_name" => "Рижская",
                "lat" => "55.792494",
                "lng" => "37.636114"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.725",
                "station_name" => "Каланчёвская",
                "lat" => "55.77667",
                "lng" => "37.65111"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.726",
                "station_name" => "Курская",
                "lat" => "55.757622",
                "lng" => "37.660767"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.727",
                "station_name" => "Москва Товарная",
                "lat" => "55.745358",
                "lng" => "37.688839"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.728",
                "station_name" => "Калитники",
                "lat" => "55.733981",
                "lng" => "37.702203"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.729",
                "station_name" => "Новохохловская",
                "lat" => "55.718523",
                "lng" => "37.719236"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.730",
                "station_name" => "Текстильщики",
                "lat" => "55.708934",
                "lng" => "37.731283"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.731",
                "station_name" => "Люблино",
                "lat" => "55.676596",
                "lng" => "37.761639"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.732",
                "station_name" => "Депо",
                "lat" => "55.674257",
                "lng" => "37.728446"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.733",
                "station_name" => "Перерва",
                "lat" => "55.660809",
                "lng" => "37.716278"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.807",
                "station_name" => "Курьяново",
                "lat" => "55.649722",
                "lng" => "37.701667"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.734",
                "station_name" => "Москворечье",
                "lat" => "55.641239",
                "lng" => "37.689789"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.735",
                "station_name" => "Царицыно",
                "lat" => "55.618309",
                "lng" => "37.668846"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.736",
                "station_name" => "Покровское",
                "lat" => "55.814247",
                "lng" => "37.47678"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.737",
                "station_name" => "Красный строитель",
                "lat" => "55.589455",
                "lng" => "37.615093"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.738",
                "station_name" => "Битца",
                "lat" => "55.571186",
                "lng" => "37.611443"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.739",
                "station_name" => "Бутово",
                "lat" => "55.548279",
                "lng" => "37.555668"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.740",
                "station_name" => "Щербинка",
                "lat" => "55.509724",
                "lng" => "37.562008"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.741",
                "station_name" => "Остафьево",
                "lat" => "55.50337",
                "lng" => "37.520055"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.742",
                "station_name" => "Силикатная",
                "lat" => "55.470278",
                "lng" => "37.555278"
            ],

            [
                "city_id" => 1,
                "city_name" => "Москва",
                "line_id" => "132",
                "line_name" => "МЦД - 2",
                "line_color" => "E74683",
                "station_id" => "132.743",
                "station_name" => "Подольск",
                "lat" => "55.431667",
                "lng" => "37.565"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "14",
                "line_name" => "Кировско-Выборгская",
                "line_color" => "D6083B",
                "station_id" => "14.190",
                "station_name" => "Девяткино",
                "lat" => "60.050182",
                "lng" => "30.443045"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "14",
                "line_name" => "Кировско-Выборгская",
                "line_color" => "D6083B",
                "station_id" => "14.191",
                "station_name" => "Гражданский проспект",
                "lat" => "60.034969",
                "lng" => "30.418224"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "14",
                "line_name" => "Кировско-Выборгская",
                "line_color" => "D6083B",
                "station_id" => "14.192",
                "station_name" => "Академическая",
                "lat" => "60.012806",
                "lng" => "30.396044"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "14",
                "line_name" => "Кировско-Выборгская",
                "line_color" => "D6083B",
                "station_id" => "14.193",
                "station_name" => "Политехническая",
                "lat" => "60.008942",
                "lng" => "30.370907"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "14",
                "line_name" => "Кировско-Выборгская",
                "line_color" => "D6083B",
                "station_id" => "14.194",
                "station_name" => "Площадь Мужества",
                "lat" => "59.999828",
                "lng" => "30.366159"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "14",
                "line_name" => "Кировско-Выборгская",
                "line_color" => "D6083B",
                "station_id" => "14.195",
                "station_name" => "Лесная",
                "lat" => "59.984947",
                "lng" => "30.344259"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "14",
                "line_name" => "Кировско-Выборгская",
                "line_color" => "D6083B",
                "station_id" => "14.196",
                "station_name" => "Выборгская",
                "lat" => "59.970925",
                "lng" => "30.347408"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "14",
                "line_name" => "Кировско-Выборгская",
                "line_color" => "D6083B",
                "station_id" => "14.197",
                "station_name" => "Площадь Ленина",
                "lat" => "59.955611",
                "lng" => "30.35605"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "14",
                "line_name" => "Кировско-Выборгская",
                "line_color" => "D6083B",
                "station_id" => "14.198",
                "station_name" => "Чернышевская",
                "lat" => "59.94453",
                "lng" => "30.359919"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "14",
                "line_name" => "Кировско-Выборгская",
                "line_color" => "D6083B",
                "station_id" => "14.199",
                "station_name" => "Площадь Восстания",
                "lat" => "59.930279",
                "lng" => "30.361069"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "14",
                "line_name" => "Кировско-Выборгская",
                "line_color" => "D6083B",
                "station_id" => "14.200",
                "station_name" => "Владимирская",
                "lat" => "59.927628",
                "lng" => "30.347898"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "14",
                "line_name" => "Кировско-Выборгская",
                "line_color" => "D6083B",
                "station_id" => "14.201",
                "station_name" => "Пушкинская",
                "lat" => "59.92065",
                "lng" => "30.329599"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "14",
                "line_name" => "Кировско-Выборгская",
                "line_color" => "D6083B",
                "station_id" => "14.202",
                "station_name" => "Технологический институт 1",
                "lat" => "59.916512",
                "lng" => "30.318485"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "14",
                "line_name" => "Кировско-Выборгская",
                "line_color" => "D6083B",
                "station_id" => "14.203",
                "station_name" => "Балтийская",
                "lat" => "59.907211",
                "lng" => "30.299578"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "14",
                "line_name" => "Кировско-Выборгская",
                "line_color" => "D6083B",
                "station_id" => "14.204",
                "station_name" => "Нарвская",
                "lat" => "59.901218",
                "lng" => "30.274908"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "14",
                "line_name" => "Кировско-Выборгская",
                "line_color" => "D6083B",
                "station_id" => "14.205",
                "station_name" => "Кировский завод",
                "lat" => "59.879688",
                "lng" => "30.261921"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "14",
                "line_name" => "Кировско-Выборгская",
                "line_color" => "D6083B",
                "station_id" => "14.206",
                "station_name" => "Автово",
                "lat" => "59.867325",
                "lng" => "30.261337"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "14",
                "line_name" => "Кировско-Выборгская",
                "line_color" => "D6083B",
                "station_id" => "14.207",
                "station_name" => "Ленинский проспект",
                "lat" => "59.85117",
                "lng" => "30.268274"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "14",
                "line_name" => "Кировско-Выборгская",
                "line_color" => "D6083B",
                "station_id" => "14.208",
                "station_name" => "Проспект Ветеранов",
                "lat" => "59.84211",
                "lng" => "30.250588"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "15",
                "line_name" => "Московско-Петроградская",
                "line_color" => "0078C9",
                "station_id" => "15.209",
                "station_name" => "Парнас",
                "lat" => "60.06699",
                "lng" => "30.333839"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "15",
                "line_name" => "Московско-Петроградская",
                "line_color" => "0078C9",
                "station_id" => "15.210",
                "station_name" => "Проспект Просвещения",
                "lat" => "60.051456",
                "lng" => "30.332544"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "15",
                "line_name" => "Московско-Петроградская",
                "line_color" => "0078C9",
                "station_id" => "15.211",
                "station_name" => "Озерки",
                "lat" => "60.037098",
                "lng" => "30.321495"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "15",
                "line_name" => "Московско-Петроградская",
                "line_color" => "0078C9",
                "station_id" => "15.212",
                "station_name" => "Удельная",
                "lat" => "60.016697",
                "lng" => "30.315607"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "15",
                "line_name" => "Московско-Петроградская",
                "line_color" => "0078C9",
                "station_id" => "15.213",
                "station_name" => "Пионерская",
                "lat" => "60.002487",
                "lng" => "30.296759"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "15",
                "line_name" => "Московско-Петроградская",
                "line_color" => "0078C9",
                "station_id" => "15.214",
                "station_name" => "Чёрная речка",
                "lat" => "59.985455",
                "lng" => "30.300833"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "15",
                "line_name" => "Московско-Петроградская",
                "line_color" => "0078C9",
                "station_id" => "15.215",
                "station_name" => "Петроградская",
                "lat" => "59.966389",
                "lng" => "30.311293"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "15",
                "line_name" => "Московско-Петроградская",
                "line_color" => "0078C9",
                "station_id" => "15.216",
                "station_name" => "Горьковская",
                "lat" => "59.956112",
                "lng" => "30.31889"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "15",
                "line_name" => "Московско-Петроградская",
                "line_color" => "0078C9",
                "station_id" => "15.217",
                "station_name" => "Невский проспект",
                "lat" => "59.935421",
                "lng" => "30.327052"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "15",
                "line_name" => "Московско-Петроградская",
                "line_color" => "0078C9",
                "station_id" => "15.218",
                "station_name" => "Сенная площадь",
                "lat" => "59.927135",
                "lng" => "30.320316"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "15",
                "line_name" => "Московско-Петроградская",
                "line_color" => "0078C9",
                "station_id" => "15.219",
                "station_name" => "Технологический институт 2",
                "lat" => "59.916512",
                "lng" => "30.318485"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "15",
                "line_name" => "Московско-Петроградская",
                "line_color" => "0078C9",
                "station_id" => "15.220",
                "station_name" => "Фрунзенская",
                "lat" => "59.906273",
                "lng" => "30.31745"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "15",
                "line_name" => "Московско-Петроградская",
                "line_color" => "0078C9",
                "station_id" => "15.221",
                "station_name" => "Московские ворота",
                "lat" => "59.891788",
                "lng" => "30.317873"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "15",
                "line_name" => "Московско-Петроградская",
                "line_color" => "0078C9",
                "station_id" => "15.222",
                "station_name" => "Электросила",
                "lat" => "59.879189",
                "lng" => "30.318659"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "15",
                "line_name" => "Московско-Петроградская",
                "line_color" => "0078C9",
                "station_id" => "15.223",
                "station_name" => "Парк Победы",
                "lat" => "59.866344",
                "lng" => "30.321802"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "15",
                "line_name" => "Московско-Петроградская",
                "line_color" => "0078C9",
                "station_id" => "15.224",
                "station_name" => "Московская",
                "lat" => "59.848873",
                "lng" => "30.321483"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "15",
                "line_name" => "Московско-Петроградская",
                "line_color" => "0078C9",
                "station_id" => "15.225",
                "station_name" => "Звёздная",
                "lat" => "59.833241",
                "lng" => "30.349428"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "15",
                "line_name" => "Московско-Петроградская",
                "line_color" => "0078C9",
                "station_id" => "15.226",
                "station_name" => "Купчино",
                "lat" => "59.829781",
                "lng" => "30.375702"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "16",
                "line_name" => "Невско-Василеостровская",
                "line_color" => "009A49",
                "station_id" => "16.604",
                "station_name" => "Беговая",
                "lat" => "59.98723",
                "lng" => "30.20247"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "16",
                "line_name" => "Невско-Василеостровская",
                "line_color" => "009A49",
                "station_id" => "16.227",
                "station_name" => "Приморская",
                "lat" => "59.948521",
                "lng" => "30.23447"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "16",
                "line_name" => "Невско-Василеостровская",
                "line_color" => "009A49",
                "station_id" => "16.228",
                "station_name" => "Василеостровская",
                "lat" => "59.942577",
                "lng" => "30.278254"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "16",
                "line_name" => "Невско-Василеостровская",
                "line_color" => "009A49",
                "station_id" => "16.229",
                "station_name" => "Гостиный двор",
                "lat" => "59.933933",
                "lng" => "30.33341"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "16",
                "line_name" => "Невско-Василеостровская",
                "line_color" => "009A49",
                "station_id" => "16.230",
                "station_name" => "Маяковская",
                "lat" => "59.931366",
                "lng" => "30.354645"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "16",
                "line_name" => "Невско-Василеостровская",
                "line_color" => "009A49",
                "station_id" => "16.231",
                "station_name" => "Площадь Александра Невского 1",
                "lat" => "59.924369",
                "lng" => "30.384989"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "16",
                "line_name" => "Невско-Василеостровская",
                "line_color" => "009A49",
                "station_id" => "16.232",
                "station_name" => "Елизаровская",
                "lat" => "59.89669",
                "lng" => "30.423656"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "16",
                "line_name" => "Невско-Василеостровская",
                "line_color" => "009A49",
                "station_id" => "16.233",
                "station_name" => "Ломоносовская",
                "lat" => "59.877342",
                "lng" => "30.441715"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "16",
                "line_name" => "Невско-Василеостровская",
                "line_color" => "009A49",
                "station_id" => "16.234",
                "station_name" => "Пролетарская",
                "lat" => "59.865",
                "lng" => "30.47"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "16",
                "line_name" => "Невско-Василеостровская",
                "line_color" => "009A49",
                "station_id" => "16.235",
                "station_name" => "Обухово",
                "lat" => "59.848709",
                "lng" => "30.457743"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "16",
                "line_name" => "Невско-Василеостровская",
                "line_color" => "009A49",
                "station_id" => "16.236",
                "station_name" => "Рыбацкое",
                "lat" => "59.830986",
                "lng" => "30.501259"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "16",
                "line_name" => "Невско-Василеостровская",
                "line_color" => "009A49",
                "station_id" => "16.808",
                "station_name" => "Зенит",
                "lat" => "59.972222",
                "lng" => "30.211667"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "17",
                "line_name" => "Правобережная",
                "line_color" => "EA7125",
                "station_id" => "17.237",
                "station_name" => "Спасская",
                "lat" => "59.927135",
                "lng" => "30.320316"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "17",
                "line_name" => "Правобережная",
                "line_color" => "EA7125",
                "station_id" => "17.238",
                "station_name" => "Достоевская",
                "lat" => "59.928234",
                "lng" => "30.346029"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "17",
                "line_name" => "Правобережная",
                "line_color" => "EA7125",
                "station_id" => "17.239",
                "station_name" => "Лиговский проспект",
                "lat" => "59.920811",
                "lng" => "30.355055"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "17",
                "line_name" => "Правобережная",
                "line_color" => "EA7125",
                "station_id" => "17.240",
                "station_name" => "Площадь Александра Невского 2",
                "lat" => "59.923563",
                "lng" => "30.383421"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "17",
                "line_name" => "Правобережная",
                "line_color" => "EA7125",
                "station_id" => "17.241",
                "station_name" => "Новочеркасская",
                "lat" => "59.929092",
                "lng" => "30.411915"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "17",
                "line_name" => "Правобережная",
                "line_color" => "EA7125",
                "station_id" => "17.242",
                "station_name" => "Ладожская",
                "lat" => "59.93243",
                "lng" => "30.439274"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "17",
                "line_name" => "Правобережная",
                "line_color" => "EA7125",
                "station_id" => "17.243",
                "station_name" => "Проспект Большевиков",
                "lat" => "59.919838",
                "lng" => "30.466757"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "17",
                "line_name" => "Правобережная",
                "line_color" => "EA7125",
                "station_id" => "17.244",
                "station_name" => "Улица Дыбенко",
                "lat" => "59.907417",
                "lng" => "30.483311"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "18",
                "line_name" => "Фрунзенско-Приморская",
                "line_color" => "702785",
                "station_id" => "18.245",
                "station_name" => "Комендантский проспект",
                "lat" => "60.008591",
                "lng" => "30.258663"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "18",
                "line_name" => "Фрунзенско-Приморская",
                "line_color" => "702785",
                "station_id" => "18.246",
                "station_name" => "Старая Деревня",
                "lat" => "59.989433",
                "lng" => "30.255163"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "18",
                "line_name" => "Фрунзенско-Приморская",
                "line_color" => "702785",
                "station_id" => "18.247",
                "station_name" => "Крестовский остров",
                "lat" => "59.971821",
                "lng" => "30.259436"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "18",
                "line_name" => "Фрунзенско-Приморская",
                "line_color" => "702785",
                "station_id" => "18.248",
                "station_name" => "Чкаловская",
                "lat" => "59.961033",
                "lng" => "30.292006"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "18",
                "line_name" => "Фрунзенско-Приморская",
                "line_color" => "702785",
                "station_id" => "18.249",
                "station_name" => "Спортивная",
                "lat" => "59.952026",
                "lng" => "30.291338"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "18",
                "line_name" => "Фрунзенско-Приморская",
                "line_color" => "702785",
                "station_id" => "18.258",
                "station_name" => "Адмиралтейская",
                "lat" => "59.935867",
                "lng" => "30.31523"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "18",
                "line_name" => "Фрунзенско-Приморская",
                "line_color" => "702785",
                "station_id" => "18.250",
                "station_name" => "Садовая",
                "lat" => "59.926739",
                "lng" => "30.317753"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "18",
                "line_name" => "Фрунзенско-Приморская",
                "line_color" => "702785",
                "station_id" => "18.251",
                "station_name" => "Звенигородская",
                "lat" => "59.92065",
                "lng" => "30.329599"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "18",
                "line_name" => "Фрунзенско-Приморская",
                "line_color" => "702785",
                "station_id" => "18.252",
                "station_name" => "Обводный Канал",
                "lat" => "59.914686",
                "lng" => "30.34815"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "18",
                "line_name" => "Фрунзенско-Приморская",
                "line_color" => "702785",
                "station_id" => "18.253",
                "station_name" => "Волковская",
                "lat" => "59.896023",
                "lng" => "30.35754"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "18",
                "line_name" => "Фрунзенско-Приморская",
                "line_color" => "702785",
                "station_id" => "18.259",
                "station_name" => "Бухарестская",
                "lat" => "59.883769",
                "lng" => "30.368932"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "18",
                "line_name" => "Фрунзенско-Приморская",
                "line_color" => "702785",
                "station_id" => "18.260",
                "station_name" => "Международная",
                "lat" => "59.870203",
                "lng" => "30.379289"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "18",
                "line_name" => "Фрунзенско-Приморская",
                "line_color" => "702785",
                "station_id" => "18.682",
                "station_name" => "Дунайская",
                "lat" => "59.839889",
                "lng" => "30.410667"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "18",
                "line_name" => "Фрунзенско-Приморская",
                "line_color" => "702785",
                "station_id" => "18.683",
                "station_name" => "Проспект Славы",
                "lat" => "59.856704",
                "lng" => "30.395402"
            ],

            [
                "city_id" => 2,
                "city_name" => "Санкт-Петербург",
                "line_id" => "18",
                "line_name" => "Фрунзенско-Приморская",
                "line_color" => "702785",
                "station_id" => "18.684",
                "station_name" => "Шушары",
                "lat" => "59.819973",
                "lng" => "30.432718"
            ],

            [
                "city_id" => 3,
                "city_name" => "Екатеринбург",
                "line_id" => "48",
                "line_name" => "Север-Юг",
                "line_color" => "0A6F20",
                "station_id" => "48.261",
                "station_name" => "Проспект Космонавтов",
                "lat" => "56.900393",
                "lng" => "60.613878"
            ],

            [
                "city_id" => 3,
                "city_name" => "Екатеринбург",
                "line_id" => "48",
                "line_name" => "Север-Юг",
                "line_color" => "0A6F20",
                "station_id" => "48.262",
                "station_name" => "Уралмаш",
                "lat" => "56.887674",
                "lng" => "60.614165"
            ],

            [
                "city_id" => 3,
                "city_name" => "Екатеринбург",
                "line_id" => "48",
                "line_name" => "Север-Юг",
                "line_color" => "0A6F20",
                "station_id" => "48.263",
                "station_name" => "Машиностроителей",
                "lat" => "56.878517",
                "lng" => "60.61218"
            ],

            [
                "city_id" => 3,
                "city_name" => "Екатеринбург",
                "line_id" => "48",
                "line_name" => "Север-Юг",
                "line_color" => "0A6F20",
                "station_id" => "48.264",
                "station_name" => "Уральская",
                "lat" => "56.858056",
                "lng" => "60.600816"
            ],

            [
                "city_id" => 3,
                "city_name" => "Екатеринбург",
                "line_id" => "48",
                "line_name" => "Север-Юг",
                "line_color" => "0A6F20",
                "station_id" => "48.265",
                "station_name" => "Динамо",
                "lat" => "56.847818",
                "lng" => "60.599406"
            ],

            [
                "city_id" => 3,
                "city_name" => "Екатеринбург",
                "line_id" => "48",
                "line_name" => "Север-Юг",
                "line_color" => "0A6F20",
                "station_id" => "48.266",
                "station_name" => "Площадь 1905 года",
                "lat" => "56.837982",
                "lng" => "60.59734"
            ],

            [
                "city_id" => 3,
                "city_name" => "Екатеринбург",
                "line_id" => "48",
                "line_name" => "Север-Юг",
                "line_color" => "0A6F20",
                "station_id" => "48.267",
                "station_name" => "Геологическая",
                "lat" => "56.826715",
                "lng" => "60.603754"
            ],

            [
                "city_id" => 3,
                "city_name" => "Екатеринбург",
                "line_id" => "48",
                "line_name" => "Север-Юг",
                "line_color" => "0A6F20",
                "station_id" => "48.269",
                "station_name" => "Чкаловская",
                "lat" => "56.808502",
                "lng" => "60.610698"
            ],

            [
                "city_id" => 3,
                "city_name" => "Екатеринбург",
                "line_id" => "48",
                "line_name" => "Север-Юг",
                "line_color" => "0A6F20",
                "station_id" => "48.270",
                "station_name" => "Ботаническая",
                "lat" => "56.797487",
                "lng" => "60.633362"
            ],

            [
                "city_id" => 88,
                "city_name" => "Казань",
                "line_id" => "49",
                "line_name" => "Центральная",
                "line_color" => "CD0505",
                "station_id" => "49.462",
                "station_name" => "Авиастроительная ",
                "lat" => "55.828897",
                "lng" => "49.081403"
            ],

            [
                "city_id" => 88,
                "city_name" => "Казань",
                "line_id" => "49",
                "line_name" => "Центральная",
                "line_color" => "CD0505",
                "station_id" => "49.461",
                "station_name" => "Северный вокзал",
                "lat" => "55.841519",
                "lng" => "49.081778"
            ],

            [
                "city_id" => 88,
                "city_name" => "Казань",
                "line_id" => "49",
                "line_name" => "Центральная",
                "line_color" => "CD0505",
                "station_id" => "49.460",
                "station_name" => "Яшьлек (Юность)",
                "lat" => "55.827843",
                "lng" => "49.082905"
            ],

            [
                "city_id" => 88,
                "city_name" => "Казань",
                "line_id" => "49",
                "line_name" => "Центральная",
                "line_color" => "CD0505",
                "station_id" => "49.271",
                "station_name" => "Козья слобода",
                "lat" => "55.817608",
                "lng" => "49.097646"
            ],

            [
                "city_id" => 88,
                "city_name" => "Казань",
                "line_id" => "49",
                "line_name" => "Центральная",
                "line_color" => "CD0505",
                "station_id" => "49.272",
                "station_name" => "Кремлевская",
                "lat" => "55.795206",
                "lng" => "49.105426"
            ],

            [
                "city_id" => 88,
                "city_name" => "Казань",
                "line_id" => "49",
                "line_name" => "Центральная",
                "line_color" => "CD0505",
                "station_id" => "49.273",
                "station_name" => "Площадь Тукая",
                "lat" => "55.787163",
                "lng" => "49.122126"
            ],

            [
                "city_id" => 88,
                "city_name" => "Казань",
                "line_id" => "49",
                "line_name" => "Центральная",
                "line_color" => "CD0505",
                "station_id" => "49.274",
                "station_name" => "Суконная слобода",
                "lat" => "55.777094",
                "lng" => "49.142275"
            ],

            [
                "city_id" => 88,
                "city_name" => "Казань",
                "line_id" => "49",
                "line_name" => "Центральная",
                "line_color" => "CD0505",
                "station_id" => "49.275",
                "station_name" => "Аметьево",
                "lat" => "55.765346",
                "lng" => "49.165083"
            ],

            [
                "city_id" => 88,
                "city_name" => "Казань",
                "line_id" => "49",
                "line_name" => "Центральная",
                "line_color" => "CD0505",
                "station_id" => "49.276",
                "station_name" => "Горки",
                "lat" => "55.760763",
                "lng" => "49.189679"
            ],

            [
                "city_id" => 88,
                "city_name" => "Казань",
                "line_id" => "49",
                "line_name" => "Центральная",
                "line_color" => "CD0505",
                "station_id" => "49.277",
                "station_name" => "Проспект Победы",
                "lat" => "55.750109",
                "lng" => "49.207735"
            ],

            [
                "city_id" => 88,
                "city_name" => "Казань",
                "line_id" => "49",
                "line_name" => "Центральная",
                "line_color" => "CD0505",
                "station_id" => "49.640",
                "station_name" => "Дубравная",
                "lat" => "55.7425",
                "lng" => "49.2197"
            ],

            [
                "city_id" => 66,
                "city_name" => "Нижний Новгород",
                "line_id" => "50",
                "line_name" => "Автозаводская",
                "line_color" => "D80707",
                "station_id" => "50.278",
                "station_name" => "Горьковская",
                "lat" => "56.313933",
                "lng" => "43.99482"
            ],

            [
                "city_id" => 66,
                "city_name" => "Нижний Новгород",
                "line_id" => "50",
                "line_name" => "Автозаводская",
                "line_color" => "D80707",
                "station_id" => "50.279",
                "station_name" => "Московская",
                "lat" => "56.321097",
                "lng" => "43.945799"
            ],

            [
                "city_id" => 66,
                "city_name" => "Нижний Новгород",
                "line_id" => "50",
                "line_name" => "Автозаводская",
                "line_color" => "D80707",
                "station_id" => "50.280",
                "station_name" => "Чкаловская",
                "lat" => "56.310637",
                "lng" => "43.936933"
            ],

            [
                "city_id" => 66,
                "city_name" => "Нижний Новгород",
                "line_id" => "50",
                "line_name" => "Автозаводская",
                "line_color" => "D80707",
                "station_id" => "50.281",
                "station_name" => "Ленинская",
                "lat" => "56.297798",
                "lng" => "43.937328"
            ],

            [
                "city_id" => 66,
                "city_name" => "Нижний Новгород",
                "line_id" => "50",
                "line_name" => "Автозаводская",
                "line_color" => "D80707",
                "station_id" => "50.282",
                "station_name" => "Заречная",
                "lat" => "56.285144",
                "lng" => "43.927528"
            ],

            [
                "city_id" => 66,
                "city_name" => "Нижний Новгород",
                "line_id" => "50",
                "line_name" => "Автозаводская",
                "line_color" => "D80707",
                "station_id" => "50.283",
                "station_name" => "Двигатель Революции",
                "lat" => "56.277093",
                "lng" => "43.922012"
            ],

            [
                "city_id" => 66,
                "city_name" => "Нижний Новгород",
                "line_id" => "50",
                "line_name" => "Автозаводская",
                "line_color" => "D80707",
                "station_id" => "50.284",
                "station_name" => "Пролетарская",
                "lat" => "56.266922",
                "lng" => "43.914143"
            ],

            [
                "city_id" => 66,
                "city_name" => "Нижний Новгород",
                "line_id" => "50",
                "line_name" => "Автозаводская",
                "line_color" => "D80707",
                "station_id" => "50.285",
                "station_name" => "Автозаводская",
                "lat" => "56.257243",
                "lng" => "43.902357"
            ],

            [
                "city_id" => 66,
                "city_name" => "Нижний Новгород",
                "line_id" => "50",
                "line_name" => "Автозаводская",
                "line_color" => "D80707",
                "station_id" => "50.286",
                "station_name" => "Комсомольская",
                "lat" => "56.252662",
                "lng" => "43.889888"
            ],

            [
                "city_id" => 66,
                "city_name" => "Нижний Новгород",
                "line_id" => "50",
                "line_name" => "Автозаводская",
                "line_color" => "D80707",
                "station_id" => "50.287",
                "station_name" => "Кировская",
                "lat" => "56.247426",
                "lng" => "43.876719"
            ],

            [
                "city_id" => 66,
                "city_name" => "Нижний Новгород",
                "line_id" => "50",
                "line_name" => "Автозаводская",
                "line_color" => "D80707",
                "station_id" => "50.288",
                "station_name" => "Парк Культуры",
                "lat" => "56.242034",
                "lng" => "43.85816"
            ],

            [
                "city_id" => 66,
                "city_name" => "Нижний Новгород",
                "line_id" => "51",
                "line_name" => "Сормовская",
                "line_color" => "0071BC",
                "station_id" => "51.606",
                "station_name" => "Стрелка",
                "lat" => "56.3343",
                "lng" => "43.9597"
            ],

            [
                "city_id" => 66,
                "city_name" => "Нижний Новгород",
                "line_id" => "51",
                "line_name" => "Сормовская",
                "line_color" => "0071BC",
                "station_id" => "51.289",
                "station_name" => "Московская",
                "lat" => "56.321097",
                "lng" => "43.945799"
            ],

            [
                "city_id" => 66,
                "city_name" => "Нижний Новгород",
                "line_id" => "51",
                "line_name" => "Сормовская",
                "line_color" => "0071BC",
                "station_id" => "51.290",
                "station_name" => "Канавинская",
                "lat" => "56.320273",
                "lng" => "43.927438"
            ],

            [
                "city_id" => 66,
                "city_name" => "Нижний Новгород",
                "line_id" => "51",
                "line_name" => "Сормовская",
                "line_color" => "0071BC",
                "station_id" => "51.291",
                "station_name" => "Бурнаковская",
                "lat" => "56.325704",
                "lng" => "43.911897"
            ],

            [
                "city_id" => 66,
                "city_name" => "Нижний Новгород",
                "line_id" => "51",
                "line_name" => "Сормовская",
                "line_color" => "0071BC",
                "station_id" => "51.292",
                "station_name" => "Буревестник",
                "lat" => "56.333834",
                "lng" => "43.892799"
            ],

            [
                "city_id" => 4,
                "city_name" => "Новосибирск",
                "line_id" => "52",
                "line_name" => "Ленинская",
                "line_color" => "CD0505",
                "station_id" => "52.294",
                "station_name" => "Заельцовская",
                "lat" => "55.059291",
                "lng" => "82.912569"
            ],

            [
                "city_id" => 4,
                "city_name" => "Новосибирск",
                "line_id" => "52",
                "line_name" => "Ленинская",
                "line_color" => "CD0505",
                "station_id" => "52.295",
                "station_name" => "Гагаринская",
                "lat" => "55.051071",
                "lng" => "82.91477"
            ],

            [
                "city_id" => 4,
                "city_name" => "Новосибирск",
                "line_id" => "52",
                "line_name" => "Ленинская",
                "line_color" => "CD0505",
                "station_id" => "52.296",
                "station_name" => "Красный проспект",
                "lat" => "55.040998",
                "lng" => "82.917447"
            ],

            [
                "city_id" => 4,
                "city_name" => "Новосибирск",
                "line_id" => "52",
                "line_name" => "Ленинская",
                "line_color" => "CD0505",
                "station_id" => "52.297",
                "station_name" => "Площадь Ленина",
                "lat" => "55.029941",
                "lng" => "82.92069"
            ],

            [
                "city_id" => 4,
                "city_name" => "Новосибирск",
                "line_id" => "52",
                "line_name" => "Ленинская",
                "line_color" => "CD0505",
                "station_id" => "52.298",
                "station_name" => "Октябрьская",
                "lat" => "55.018789",
                "lng" => "82.939007"
            ],

            [
                "city_id" => 4,
                "city_name" => "Новосибирск",
                "line_id" => "52",
                "line_name" => "Ленинская",
                "line_color" => "CD0505",
                "station_id" => "52.299",
                "station_name" => "Речной вокзал",
                "lat" => "55.008738",
                "lng" => "82.93827"
            ],

            [
                "city_id" => 4,
                "city_name" => "Новосибирск",
                "line_id" => "52",
                "line_name" => "Ленинская",
                "line_color" => "CD0505",
                "station_id" => "52.300",
                "station_name" => "Студенческая",
                "lat" => "54.989089",
                "lng" => "82.906631"
            ],

            [
                "city_id" => 4,
                "city_name" => "Новосибирск",
                "line_id" => "52",
                "line_name" => "Ленинская",
                "line_color" => "CD0505",
                "station_id" => "52.301",
                "station_name" => "Площадь Маркса",
                "lat" => "54.982931",
                "lng" => "82.89313"
            ],

            [
                "city_id" => 4,
                "city_name" => "Новосибирск",
                "line_id" => "53",
                "line_name" => "Дзержинская",
                "line_color" => "0A6F20",
                "station_id" => "53.302",
                "station_name" => "Площадь Гарина-Михайловского",
                "lat" => "55.035947",
                "lng" => "82.897783"
            ],

            [
                "city_id" => 4,
                "city_name" => "Новосибирск",
                "line_id" => "53",
                "line_name" => "Дзержинская",
                "line_color" => "0A6F20",
                "station_id" => "53.303",
                "station_name" => "Сибирская",
                "lat" => "55.042163",
                "lng" => "82.919172"
            ],

            [
                "city_id" => 4,
                "city_name" => "Новосибирск",
                "line_id" => "53",
                "line_name" => "Дзержинская",
                "line_color" => "0A6F20",
                "station_id" => "53.304",
                "station_name" => "Маршала Покрышкина",
                "lat" => "55.043634",
                "lng" => "82.935566"
            ],

            [
                "city_id" => 4,
                "city_name" => "Новосибирск",
                "line_id" => "53",
                "line_name" => "Дзержинская",
                "line_color" => "0A6F20",
                "station_id" => "53.305",
                "station_name" => "Березовая роща",
                "lat" => "55.043242",
                "lng" => "82.952913"
            ],

            [
                "city_id" => 4,
                "city_name" => "Новосибирск",
                "line_id" => "53",
                "line_name" => "Дзержинская",
                "line_color" => "0A6F20",
                "station_id" => "53.306",
                "station_name" => "Золотая нива",
                "lat" => "55.037928",
                "lng" => "82.976044"
            ],

            [
                "city_id" => 78,
                "city_name" => "Самара",
                "line_id" => "54",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "54.509",
                "station_name" => "Алабинская",
                "lat" => "53.209689",
                "lng" => "50.134417"
            ],

            [
                "city_id" => 78,
                "city_name" => "Самара",
                "line_id" => "54",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "54.307",
                "station_name" => "Российская",
                "lat" => "53.211385",
                "lng" => "50.15022"
            ],

            [
                "city_id" => 78,
                "city_name" => "Самара",
                "line_id" => "54",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "54.308",
                "station_name" => "Московская",
                "lat" => "53.203791",
                "lng" => "50.159832"
            ],

            [
                "city_id" => 78,
                "city_name" => "Самара",
                "line_id" => "54",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "54.309",
                "station_name" => "Гагаринская",
                "lat" => "53.200442",
                "lng" => "50.176595"
            ],

            [
                "city_id" => 78,
                "city_name" => "Самара",
                "line_id" => "54",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "54.310",
                "station_name" => "Спортивная",
                "lat" => "53.201121",
                "lng" => "50.199286"
            ],

            [
                "city_id" => 78,
                "city_name" => "Самара",
                "line_id" => "54",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "54.311",
                "station_name" => "Советская",
                "lat" => "53.201736",
                "lng" => "50.220657"
            ],

            [
                "city_id" => 78,
                "city_name" => "Самара",
                "line_id" => "54",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "54.312",
                "station_name" => "Победа",
                "lat" => "53.207313",
                "lng" => "50.236414"
            ],

            [
                "city_id" => 78,
                "city_name" => "Самара",
                "line_id" => "54",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "54.313",
                "station_name" => "Безымянка",
                "lat" => "53.212997",
                "lng" => "50.248891"
            ],

            [
                "city_id" => 78,
                "city_name" => "Самара",
                "line_id" => "54",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "54.314",
                "station_name" => "Кировская",
                "lat" => "53.211352",
                "lng" => "50.269777"
            ],

            [
                "city_id" => 78,
                "city_name" => "Самара",
                "line_id" => "54",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "54.315",
                "station_name" => "Юнгородок",
                "lat" => "53.212701",
                "lng" => "50.282982"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "55",
                "line_name" => "Святошинско-Броварская",
                "line_color" => "CD0505",
                "station_id" => "55.316",
                "station_name" => "Академгородок",
                "lat" => "50.464784",
                "lng" => "30.355511"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "55",
                "line_name" => "Святошинско-Броварская",
                "line_color" => "CD0505",
                "station_id" => "55.317",
                "station_name" => "Житомирская",
                "lat" => "50.455884",
                "lng" => "30.36479"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "55",
                "line_name" => "Святошинско-Броварская",
                "line_color" => "CD0505",
                "station_id" => "55.318",
                "station_name" => "Святошин",
                "lat" => "50.457685",
                "lng" => "30.391776"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "55",
                "line_name" => "Святошинско-Броварская",
                "line_color" => "CD0505",
                "station_id" => "55.319",
                "station_name" => "Нивки",
                "lat" => "50.458602",
                "lng" => "30.405682"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "55",
                "line_name" => "Святошинско-Броварская",
                "line_color" => "CD0505",
                "station_id" => "55.320",
                "station_name" => "Берестейская",
                "lat" => "50.458562",
                "lng" => "30.420522"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "55",
                "line_name" => "Святошинско-Броварская",
                "line_color" => "CD0505",
                "station_id" => "55.321",
                "station_name" => "Шулявская",
                "lat" => "50.454622",
                "lng" => "30.445208"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "55",
                "line_name" => "Святошинско-Броварская",
                "line_color" => "CD0505",
                "station_id" => "55.322",
                "station_name" => "Политехнический институт",
                "lat" => "50.450814",
                "lng" => "30.466327"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "55",
                "line_name" => "Святошинско-Броварская",
                "line_color" => "CD0505",
                "station_id" => "55.323",
                "station_name" => "Вокзальная",
                "lat" => "50.44178",
                "lng" => "30.488273"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "55",
                "line_name" => "Святошинско-Броварская",
                "line_color" => "CD0505",
                "station_id" => "55.324",
                "station_name" => "Университет",
                "lat" => "50.444401",
                "lng" => "30.506006"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "55",
                "line_name" => "Святошинско-Броварская",
                "line_color" => "CD0505",
                "station_id" => "55.325",
                "station_name" => "Театральная",
                "lat" => "50.445135",
                "lng" => "30.518178"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "55",
                "line_name" => "Святошинско-Броварская",
                "line_color" => "CD0505",
                "station_id" => "55.326",
                "station_name" => "Крещатик",
                "lat" => "50.447218",
                "lng" => "30.524933"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "55",
                "line_name" => "Святошинско-Броварская",
                "line_color" => "CD0505",
                "station_id" => "55.327",
                "station_name" => "Арсенальная",
                "lat" => "50.444332",
                "lng" => "30.545379"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "55",
                "line_name" => "Святошинско-Броварская",
                "line_color" => "CD0505",
                "station_id" => "55.328",
                "station_name" => "Днепр",
                "lat" => "50.441217",
                "lng" => "30.559374"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "55",
                "line_name" => "Святошинско-Броварская",
                "line_color" => "CD0505",
                "station_id" => "55.329",
                "station_name" => "Гидропарк",
                "lat" => "50.445956",
                "lng" => "30.57699"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "55",
                "line_name" => "Святошинско-Броварская",
                "line_color" => "CD0505",
                "station_id" => "55.330",
                "station_name" => "Левобережная",
                "lat" => "50.4518",
                "lng" => "30.59811"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "55",
                "line_name" => "Святошинско-Броварская",
                "line_color" => "CD0505",
                "station_id" => "55.331",
                "station_name" => "Дарница",
                "lat" => "50.455924",
                "lng" => "30.612905"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "55",
                "line_name" => "Святошинско-Броварская",
                "line_color" => "CD0505",
                "station_id" => "55.332",
                "station_name" => "Черниговская",
                "lat" => "50.459852",
                "lng" => "30.630269"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "55",
                "line_name" => "Святошинско-Броварская",
                "line_color" => "CD0505",
                "station_id" => "55.333",
                "station_name" => "Лесная",
                "lat" => "50.464629",
                "lng" => "30.645541"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "56",
                "line_name" => "Куреневско-Красноармейская",
                "line_color" => "069CD3",
                "station_id" => "56.334",
                "station_name" => "Героев Днепра",
                "lat" => "50.52258",
                "lng" => "30.498891"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "56",
                "line_name" => "Куреневско-Красноармейская",
                "line_color" => "069CD3",
                "station_id" => "56.335",
                "station_name" => "Минская",
                "lat" => "50.512196",
                "lng" => "30.498541"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "56",
                "line_name" => "Куреневско-Красноармейская",
                "line_color" => "069CD3",
                "station_id" => "56.336",
                "station_name" => "Оболонь",
                "lat" => "50.501466",
                "lng" => "30.498253"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "56",
                "line_name" => "Куреневско-Красноармейская",
                "line_color" => "069CD3",
                "station_id" => "56.337",
                "station_name" => "Петровка",
                "lat" => "50.486074",
                "lng" => "30.497885"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "56",
                "line_name" => "Куреневско-Красноармейская",
                "line_color" => "069CD3",
                "station_id" => "56.338",
                "station_name" => "Тараса Шевченко",
                "lat" => "50.473286",
                "lng" => "30.505134"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "56",
                "line_name" => "Куреневско-Красноармейская",
                "line_color" => "069CD3",
                "station_id" => "56.339",
                "station_name" => "Контрактовая площадь",
                "lat" => "50.465604",
                "lng" => "30.514836"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "56",
                "line_name" => "Куреневско-Красноармейская",
                "line_color" => "069CD3",
                "station_id" => "56.340",
                "station_name" => "Почтовая площадь",
                "lat" => "50.458935",
                "lng" => "30.524933"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "56",
                "line_name" => "Куреневско-Красноармейская",
                "line_color" => "069CD3",
                "station_id" => "56.341",
                "station_name" => "Майдан Независимости",
                "lat" => "50.450028",
                "lng" => "30.524196"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "56",
                "line_name" => "Куреневско-Красноармейская",
                "line_color" => "069CD3",
                "station_id" => "56.342",
                "station_name" => "Площадь Льва Толстого",
                "lat" => "50.439221",
                "lng" => "30.516327"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "56",
                "line_name" => "Куреневско-Красноармейская",
                "line_color" => "069CD3",
                "station_id" => "56.343",
                "station_name" => "Олимпийская",
                "lat" => "50.432244",
                "lng" => "30.51621"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "56",
                "line_name" => "Куреневско-Красноармейская",
                "line_color" => "069CD3",
                "station_id" => "56.344",
                "station_name" => "Дворец \"Украина\"",
                "lat" => "50.420641",
                "lng" => "30.520738"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "56",
                "line_name" => "Куреневско-Красноармейская",
                "line_color" => "069CD3",
                "station_id" => "56.345",
                "station_name" => "Лыбедская",
                "lat" => "50.412714",
                "lng" => "30.524879"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "56",
                "line_name" => "Куреневско-Красноармейская",
                "line_color" => "069CD3",
                "station_id" => "56.346",
                "station_name" => "Демиевская",
                "lat" => "50.404563",
                "lng" => "30.516615"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "56",
                "line_name" => "Куреневско-Красноармейская",
                "line_color" => "069CD3",
                "station_id" => "56.347",
                "station_name" => "Голосеевская",
                "lat" => "50.397879",
                "lng" => "30.510066"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "56",
                "line_name" => "Куреневско-Красноармейская",
                "line_color" => "069CD3",
                "station_id" => "56.348",
                "station_name" => "Васильковская",
                "lat" => "50.392815",
                "lng" => "30.485551"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "56",
                "line_name" => "Куреневско-Красноармейская",
                "line_color" => "069CD3",
                "station_id" => "56.349",
                "station_name" => "Выставочный центр",
                "lat" => "50.382092",
                "lng" => "30.477134"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "56",
                "line_name" => "Куреневско-Красноармейская",
                "line_color" => "069CD3",
                "station_id" => "56.350",
                "station_name" => "Ипподром",
                "lat" => "50.376526",
                "lng" => "30.468923"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "56",
                "line_name" => "Куреневско-Красноармейская",
                "line_color" => "069CD3",
                "station_id" => "56.506",
                "station_name" => "Теремки",
                "lat" => "50.367044",
                "lng" => "30.454203"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "57",
                "line_name" => "Сырецко-Печерская",
                "line_color" => "0A6F20",
                "station_id" => "57.351",
                "station_name" => "Сырец",
                "lat" => "50.476221",
                "lng" => "30.430736"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "57",
                "line_name" => "Сырецко-Печерская",
                "line_color" => "0A6F20",
                "station_id" => "57.352",
                "station_name" => "Дорогожичи",
                "lat" => "50.473452",
                "lng" => "30.448406"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "57",
                "line_name" => "Сырецко-Печерская",
                "line_color" => "0A6F20",
                "station_id" => "57.353",
                "station_name" => "Лукьяновская",
                "lat" => "50.462249",
                "lng" => "30.482101"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "57",
                "line_name" => "Сырецко-Печерская",
                "line_color" => "0A6F20",
                "station_id" => "57.354",
                "station_name" => "Золотые ворота",
                "lat" => "50.448342",
                "lng" => "30.513668"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "57",
                "line_name" => "Сырецко-Печерская",
                "line_color" => "0A6F20",
                "station_id" => "57.355",
                "station_name" => "Дворец спорта",
                "lat" => "50.437838",
                "lng" => "30.520684"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "57",
                "line_name" => "Сырецко-Печерская",
                "line_color" => "0A6F20",
                "station_id" => "57.356",
                "station_name" => "Кловская",
                "lat" => "50.436731",
                "lng" => "30.531922"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "57",
                "line_name" => "Сырецко-Печерская",
                "line_color" => "0A6F20",
                "station_id" => "57.357",
                "station_name" => "Печерская",
                "lat" => "50.427315",
                "lng" => "30.538776"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "57",
                "line_name" => "Сырецко-Печерская",
                "line_color" => "0A6F20",
                "station_id" => "57.358",
                "station_name" => "Дружбы народов",
                "lat" => "50.418001",
                "lng" => "30.544462"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "57",
                "line_name" => "Сырецко-Печерская",
                "line_color" => "0A6F20",
                "station_id" => "57.359",
                "station_name" => "Выдубичи",
                "lat" => "50.401428",
                "lng" => "30.560686"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "57",
                "line_name" => "Сырецко-Печерская",
                "line_color" => "0A6F20",
                "station_id" => "57.360",
                "station_name" => "Славутич",
                "lat" => "50.394164",
                "lng" => "30.604452"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "57",
                "line_name" => "Сырецко-Печерская",
                "line_color" => "0A6F20",
                "station_id" => "57.361",
                "station_name" => "Осокорки",
                "lat" => "50.395537",
                "lng" => "30.616148"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "57",
                "line_name" => "Сырецко-Печерская",
                "line_color" => "0A6F20",
                "station_id" => "57.362",
                "station_name" => "Позняки",
                "lat" => "50.398344",
                "lng" => "30.63433"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "57",
                "line_name" => "Сырецко-Печерская",
                "line_color" => "0A6F20",
                "station_id" => "57.363",
                "station_name" => "Харьковская",
                "lat" => "50.401072",
                "lng" => "30.652"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "57",
                "line_name" => "Сырецко-Печерская",
                "line_color" => "0A6F20",
                "station_id" => "57.364",
                "station_name" => "Вырлица",
                "lat" => "50.403185",
                "lng" => "30.665969"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "57",
                "line_name" => "Сырецко-Печерская",
                "line_color" => "0A6F20",
                "station_id" => "57.365",
                "station_name" => "Бориспольская",
                "lat" => "50.403403",
                "lng" => "30.682974"
            ],

            [
                "city_id" => 115,
                "city_name" => "Киев",
                "line_id" => "57",
                "line_name" => "Сырецко-Печерская",
                "line_color" => "0A6F20",
                "station_id" => "57.366",
                "station_name" => "Красный хутор",
                "lat" => "50.409505",
                "lng" => "30.695918"
            ],

            [
                "city_id" => 117,
                "city_name" => "Днепр (Днепропетровск)",
                "line_id" => "58",
                "line_name" => "Центрально-Заводская",
                "line_color" => "BD1018",
                "station_id" => "58.367",
                "station_name" => "Вокзальная",
                "lat" => "48.475457",
                "lng" => "35.015926"
            ],

            [
                "city_id" => 117,
                "city_name" => "Днепр (Днепропетровск)",
                "line_id" => "58",
                "line_name" => "Центрально-Заводская",
                "line_color" => "BD1018",
                "station_id" => "58.368",
                "station_name" => "Метростроителей",
                "lat" => "48.475218",
                "lng" => "34.995731"
            ],

            [
                "city_id" => 117,
                "city_name" => "Днепр (Днепропетровск)",
                "line_id" => "58",
                "line_name" => "Центрально-Заводская",
                "line_color" => "BD1018",
                "station_id" => "58.369",
                "station_name" => "Металлургов",
                "lat" => "48.476634",
                "lng" => "34.979517"
            ],

            [
                "city_id" => 117,
                "city_name" => "Днепр (Днепропетровск)",
                "line_id" => "58",
                "line_name" => "Центрально-Заводская",
                "line_color" => "BD1018",
                "station_id" => "58.370",
                "station_name" => "Заводская",
                "lat" => "48.475821",
                "lng" => "34.959422"
            ],

            [
                "city_id" => 117,
                "city_name" => "Днепр (Днепропетровск)",
                "line_id" => "58",
                "line_name" => "Центрально-Заводская",
                "line_color" => "BD1018",
                "station_id" => "58.371",
                "station_name" => "Проспект свободы",
                "lat" => "48.479871",
                "lng" => "34.943027"
            ],

            [
                "city_id" => 117,
                "city_name" => "Днепр (Днепропетровск)",
                "line_id" => "58",
                "line_name" => "Центрально-Заводская",
                "line_color" => "BD1018",
                "station_id" => "58.372",
                "station_name" => "Коммунаровская",
                "lat" => "48.479298",
                "lng" => "34.92657"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "59",
                "line_name" => "Холодногорско-Заводская",
                "line_color" => "CD0505",
                "station_id" => "59.373",
                "station_name" => "Холодная гора",
                "lat" => "49.982512",
                "lng" => "36.181804"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "59",
                "line_name" => "Холодногорско-Заводская",
                "line_color" => "CD0505",
                "station_id" => "59.374",
                "station_name" => "Южный вокзал",
                "lat" => "49.989613",
                "lng" => "36.205178"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "59",
                "line_name" => "Холодногорско-Заводская",
                "line_color" => "CD0505",
                "station_id" => "59.375",
                "station_name" => "Центральный рынок",
                "lat" => "49.99277",
                "lng" => "36.219731"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "59",
                "line_name" => "Холодногорско-Заводская",
                "line_color" => "CD0505",
                "station_id" => "59.376",
                "station_name" => "Советская",
                "lat" => "49.991084",
                "lng" => "36.232568"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "59",
                "line_name" => "Холодногорско-Заводская",
                "line_color" => "CD0505",
                "station_id" => "59.377",
                "station_name" => "Проспект Гагарина",
                "lat" => "49.980838",
                "lng" => "36.243402"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "59",
                "line_name" => "Холодногорско-Заводская",
                "line_color" => "CD0505",
                "station_id" => "59.378",
                "station_name" => "Спортивная",
                "lat" => "49.979494",
                "lng" => "36.260532"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "59",
                "line_name" => "Холодногорско-Заводская",
                "line_color" => "CD0505",
                "station_id" => "59.379",
                "station_name" => "Завод имени Малышева",
                "lat" => "49.975966",
                "lng" => "36.280996"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "59",
                "line_name" => "Холодногорско-Заводская",
                "line_color" => "CD0505",
                "station_id" => "59.380",
                "station_name" => "Московский проспект",
                "lat" => "49.972259",
                "lng" => "36.301666"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "59",
                "line_name" => "Холодногорско-Заводская",
                "line_color" => "CD0505",
                "station_id" => "59.381",
                "station_name" => "Маршала Жукова",
                "lat" => "49.966262",
                "lng" => "36.321187"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "59",
                "line_name" => "Холодногорско-Заводская",
                "line_color" => "CD0505",
                "station_id" => "59.382",
                "station_name" => "Советской армии",
                "lat" => "49.961852",
                "lng" => "36.342926"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "59",
                "line_name" => "Холодногорско-Заводская",
                "line_color" => "CD0505",
                "station_id" => "59.383",
                "station_name" => "Имени А. С. Масельского",
                "lat" => "49.958526",
                "lng" => "36.359787"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "59",
                "line_name" => "Холодногорско-Заводская",
                "line_color" => "CD0505",
                "station_id" => "59.384",
                "station_name" => "Тракторный завод",
                "lat" => "49.952614",
                "lng" => "36.37876"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "59",
                "line_name" => "Холодногорско-Заводская",
                "line_color" => "CD0505",
                "station_id" => "59.385",
                "station_name" => "Пролетарская",
                "lat" => "49.946562",
                "lng" => "36.399062"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "60",
                "line_name" => "Салтовская линия",
                "line_color" => "069CD3",
                "station_id" => "60.386",
                "station_name" => "Героев труда",
                "lat" => "50.025398",
                "lng" => "36.336287"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "60",
                "line_name" => "Салтовская линия",
                "line_color" => "069CD3",
                "station_id" => "60.387",
                "station_name" => "Студенческая",
                "lat" => "50.017683",
                "lng" => "36.329972"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "60",
                "line_name" => "Салтовская линия",
                "line_color" => "069CD3",
                "station_id" => "60.388",
                "station_name" => "Академика Павлова",
                "lat" => "50.008965",
                "lng" => "36.317755"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "60",
                "line_name" => "Салтовская линия",
                "line_color" => "069CD3",
                "station_id" => "60.389",
                "station_name" => "Академика Барабашова",
                "lat" => "50.002313",
                "lng" => "36.304092"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "60",
                "line_name" => "Салтовская линия",
                "line_color" => "069CD3",
                "station_id" => "60.390",
                "station_name" => "Киевская",
                "lat" => "50.001213",
                "lng" => "36.270279"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "60",
                "line_name" => "Салтовская линия",
                "line_color" => "069CD3",
                "station_id" => "60.391",
                "station_name" => "Пушкинская",
                "lat" => "50.003685",
                "lng" => "36.247489"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "60",
                "line_name" => "Салтовская линия",
                "line_color" => "069CD3",
                "station_id" => "60.392",
                "station_name" => "Университет",
                "lat" => "50.004501",
                "lng" => "36.233781"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "60",
                "line_name" => "Салтовская линия",
                "line_color" => "069CD3",
                "station_id" => "60.393",
                "station_name" => "Исторический музей",
                "lat" => "49.992926",
                "lng" => "36.231211"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "61",
                "line_name" => "Алексеевская",
                "line_color" => "0A6F20",
                "station_id" => "61.394",
                "station_name" => "Алексеевская",
                "lat" => "50.0496",
                "lng" => "36.20666"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "61",
                "line_name" => "Алексеевская",
                "line_color" => "0A6F20",
                "station_id" => "61.395",
                "station_name" => "23 Августа",
                "lat" => "50.035524",
                "lng" => "36.220279"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "61",
                "line_name" => "Алексеевская",
                "line_color" => "0A6F20",
                "station_id" => "61.396",
                "station_name" => "Ботанический сад",
                "lat" => "50.026659",
                "lng" => "36.222938"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "61",
                "line_name" => "Алексеевская",
                "line_color" => "0A6F20",
                "station_id" => "61.397",
                "station_name" => "Научная",
                "lat" => "50.013",
                "lng" => "36.226962"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "61",
                "line_name" => "Алексеевская",
                "line_color" => "0A6F20",
                "station_id" => "61.398",
                "station_name" => "Госпром",
                "lat" => "50.004797",
                "lng" => "36.231571"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "61",
                "line_name" => "Алексеевская",
                "line_color" => "0A6F20",
                "station_id" => "61.399",
                "station_name" => "Архитектора Бекетова",
                "lat" => "49.998966",
                "lng" => "36.240518"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "61",
                "line_name" => "Алексеевская",
                "line_color" => "0A6F20",
                "station_id" => "61.400",
                "station_name" => "Площадь Восстания",
                "lat" => "49.988652",
                "lng" => "36.264808"
            ],

            [
                "city_id" => 135,
                "city_name" => "Харьков",
                "line_id" => "61",
                "line_name" => "Алексеевская",
                "line_color" => "0A6F20",
                "station_id" => "61.401",
                "station_name" => "Метростроителей имени Ващенко",
                "lat" => "49.978915",
                "lng" => "36.262823"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "62",
                "line_name" => "Московская",
                "line_color" => "0521C3",
                "station_id" => "62.402",
                "station_name" => "Уручье",
                "lat" => "53.945348",
                "lng" => "27.68782"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "62",
                "line_name" => "Московская",
                "line_color" => "0521C3",
                "station_id" => "62.403",
                "station_name" => "Борисовский тракт",
                "lat" => "53.938506",
                "lng" => "27.665865"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "62",
                "line_name" => "Московская",
                "line_color" => "0521C3",
                "station_id" => "62.404",
                "station_name" => "Восток",
                "lat" => "53.934509",
                "lng" => "27.651483"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "62",
                "line_name" => "Московская",
                "line_color" => "0521C3",
                "station_id" => "62.405",
                "station_name" => "Московская",
                "lat" => "53.927978",
                "lng" => "27.627812"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "62",
                "line_name" => "Московская",
                "line_color" => "0521C3",
                "station_id" => "62.406",
                "station_name" => "Парк Челюскинцев",
                "lat" => "53.924214",
                "lng" => "27.613646"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "62",
                "line_name" => "Московская",
                "line_color" => "0521C3",
                "station_id" => "62.407",
                "station_name" => "Академия наук",
                "lat" => "53.92187",
                "lng" => "27.599066"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "62",
                "line_name" => "Московская",
                "line_color" => "0521C3",
                "station_id" => "62.408",
                "station_name" => "Площадь Якуба Коласа",
                "lat" => "53.915369",
                "lng" => "27.583265"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "62",
                "line_name" => "Московская",
                "line_color" => "0521C3",
                "station_id" => "62.409",
                "station_name" => "Площадь Победы",
                "lat" => "53.908644",
                "lng" => "27.575054"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "62",
                "line_name" => "Московская",
                "line_color" => "0521C3",
                "station_id" => "62.410",
                "station_name" => "Октябрьская",
                "lat" => "53.901562",
                "lng" => "27.561068"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "62",
                "line_name" => "Московская",
                "line_color" => "0521C3",
                "station_id" => "62.411",
                "station_name" => "Площадь Ленина",
                "lat" => "53.893875",
                "lng" => "27.548015"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "62",
                "line_name" => "Московская",
                "line_color" => "0521C3",
                "station_id" => "62.412",
                "station_name" => "Институт Культуры",
                "lat" => "53.885899",
                "lng" => "27.538852"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "62",
                "line_name" => "Московская",
                "line_color" => "0521C3",
                "station_id" => "62.413",
                "station_name" => "Грушевка",
                "lat" => "53.88669",
                "lng" => "27.514786"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "62",
                "line_name" => "Московская",
                "line_color" => "0521C3",
                "station_id" => "62.414",
                "station_name" => "Михалово",
                "lat" => "53.876664",
                "lng" => "27.49691"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "62",
                "line_name" => "Московская",
                "line_color" => "0521C3",
                "station_id" => "62.415",
                "station_name" => "Петровщина",
                "lat" => "53.86458",
                "lng" => "27.485807"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "62",
                "line_name" => "Московская",
                "line_color" => "0521C3",
                "station_id" => "62.472",
                "station_name" => "Малиновка",
                "lat" => "53.849722",
                "lng" => "27.474722"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "63",
                "line_name" => "Автозаводская",
                "line_color" => "BF0808",
                "station_id" => "63.416",
                "station_name" => "Каменная Горка",
                "lat" => "53.90683",
                "lng" => "27.437558"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "63",
                "line_name" => "Автозаводская",
                "line_color" => "BF0808",
                "station_id" => "63.417",
                "station_name" => "Кунцевщина",
                "lat" => "53.906236",
                "lng" => "27.453916"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "63",
                "line_name" => "Автозаводская",
                "line_color" => "BF0808",
                "station_id" => "63.418",
                "station_name" => "Спортивная",
                "lat" => "53.908501",
                "lng" => "27.48083"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "63",
                "line_name" => "Автозаводская",
                "line_color" => "BF0808",
                "station_id" => "63.419",
                "station_name" => "Пушкинская",
                "lat" => "53.909519",
                "lng" => "27.495499"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "63",
                "line_name" => "Автозаводская",
                "line_color" => "BF0808",
                "station_id" => "63.420",
                "station_name" => "Молодежная",
                "lat" => "53.906527",
                "lng" => "27.521308"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "63",
                "line_name" => "Автозаводская",
                "line_color" => "BF0808",
                "station_id" => "63.421",
                "station_name" => "Фрунзенская",
                "lat" => "53.905286",
                "lng" => "27.539328"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "63",
                "line_name" => "Автозаводская",
                "line_color" => "BF0808",
                "station_id" => "63.422",
                "station_name" => "Немига",
                "lat" => "53.905615",
                "lng" => "27.55415"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "63",
                "line_name" => "Автозаводская",
                "line_color" => "BF0808",
                "station_id" => "63.423",
                "station_name" => "Купаловская",
                "lat" => "53.901408",
                "lng" => "27.561247"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "63",
                "line_name" => "Автозаводская",
                "line_color" => "BF0808",
                "station_id" => "63.424",
                "station_name" => "Первомайская",
                "lat" => "53.893763",
                "lng" => "27.570167"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "63",
                "line_name" => "Автозаводская",
                "line_color" => "BF0808",
                "station_id" => "63.425",
                "station_name" => "Пролетарская",
                "lat" => "53.88972",
                "lng" => "27.585466"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "63",
                "line_name" => "Автозаводская",
                "line_color" => "BF0808",
                "station_id" => "63.426",
                "station_name" => "Тракторный завод",
                "lat" => "53.890033",
                "lng" => "27.614374"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "63",
                "line_name" => "Автозаводская",
                "line_color" => "BF0808",
                "station_id" => "63.427",
                "station_name" => "Партизанская",
                "lat" => "53.87582",
                "lng" => "27.628998"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "63",
                "line_name" => "Автозаводская",
                "line_color" => "BF0808",
                "station_id" => "63.428",
                "station_name" => "Автозаводская",
                "lat" => "53.868945",
                "lng" => "27.648788"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "63",
                "line_name" => "Автозаводская",
                "line_color" => "BF0808",
                "station_id" => "63.429",
                "station_name" => "Могилевская",
                "lat" => "53.861862",
                "lng" => "27.674381"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "134",
                "line_name" => "Зеленолужская",
                "line_color" => "009A49",
                "station_id" => "134.796",
                "station_name" => "Вокзальная",
                "lat" => "53.889722",
                "lng" => "27.546944"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "134",
                "line_name" => "Зеленолужская",
                "line_color" => "009A49",
                "station_id" => "134.797",
                "station_name" => "Юбилейная площадь",
                "lat" => "53.904406",
                "lng" => "27.539975"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "134",
                "line_name" => "Зеленолужская",
                "line_color" => "009A49",
                "station_id" => "134.798",
                "station_name" => "Площадь Франтишка Богушевича",
                "lat" => "53.896667",
                "lng" => "27.538333"
            ],

            [
                "city_id" => 1002,
                "city_name" => "Минск",
                "line_id" => "134",
                "line_name" => "Зеленолужская",
                "line_color" => "009A49",
                "station_id" => "134.799",
                "station_name" => "Ковальская Слобода",
                "lat" => "53.874167",
                "lng" => "27.549444"
            ],

            [
                "city_id" => 160,
                "city_name" => "Алматы",
                "line_id" => "64",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "64.430",
                "station_name" => "Райымбек батыра",
                "lat" => "43.271201",
                "lng" => "76.9448"
            ],

            [
                "city_id" => 160,
                "city_name" => "Алматы",
                "line_id" => "64",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "64.431",
                "station_name" => "Жибек Жолы",
                "lat" => "43.260199",
                "lng" => "76.946103"
            ],

            [
                "city_id" => 160,
                "city_name" => "Алматы",
                "line_id" => "64",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "64.432",
                "station_name" => "Алмалы",
                "lat" => "43.251295",
                "lng" => "76.945456"
            ],

            [
                "city_id" => 160,
                "city_name" => "Алматы",
                "line_id" => "64",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "64.433",
                "station_name" => "Абая",
                "lat" => "43.242548",
                "lng" => "76.949588"
            ],

            [
                "city_id" => 160,
                "city_name" => "Алматы",
                "line_id" => "64",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "64.434",
                "station_name" => "Байконур",
                "lat" => "43.240401",
                "lng" => "76.927696"
            ],

            [
                "city_id" => 160,
                "city_name" => "Алматы",
                "line_id" => "64",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "64.435",
                "station_name" => "Театр имени Ауэзова",
                "lat" => "43.240362",
                "lng" => "76.917519"
            ],

            [
                "city_id" => 160,
                "city_name" => "Алматы",
                "line_id" => "64",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "64.436",
                "station_name" => "Алатау",
                "lat" => "43.239041",
                "lng" => "76.897612"
            ],

            [
                "city_id" => 160,
                "city_name" => "Алматы",
                "line_id" => "64",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "64.510",
                "station_name" => "Сайран",
                "lat" => "43.2362",
                "lng" => "76.8764"
            ],

            [
                "city_id" => 160,
                "city_name" => "Алматы",
                "line_id" => "64",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "64.511",
                "station_name" => "Москва",
                "lat" => "43.23",
                "lng" => "76.867"
            ],

            [
                "city_id" => 160,
                "city_name" => "Алматы",
                "line_id" => "64",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "64.819",
                "station_name" => "Сары-Арка",
                "lat" => "43.22",
                "lng" => "76.851111"
            ],

            [
                "city_id" => 160,
                "city_name" => "Алматы",
                "line_id" => "64",
                "line_name" => "Первая",
                "line_color" => "CD0505",
                "station_id" => "64.820",
                "station_name" => "Бауыржан Момышулы",
                "lat" => "43.216389",
                "lng" => "76.838056"
            ]
        ];
        foreach ($array as $cr) {
            Metro::create($cr);
        }
    }
}
