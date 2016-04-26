<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Author seeder
        DB::table('author')->delete();
        $firstname = array('Ken', 'Terri', 'Roberto', 'Rob', 'Gail', 'Jossef', 'Dylan', 'Diane', 'Gigi', 'Michael');
        $lastname = array('Sánchez', 'Duffy', 'Tamburello', 'Walters', 'Erickson', 'Goldberg', 'Miller', 'Margheim', 'Matthew', 'Raheem');
        $countries = array(
            "Afghanistan",
            "Albania",
            "Algeria",
            "Andorra",
            "Angola",
            "Antigua and Barbuda",
            "Argentina",
            "Armenia",
            "Australia",
            "Austria",
            "Azerbaijan",
            "Bahamas",
            "Bahrain",
            "Bangladesh",
            "Barbados",
            "Belarus",
            "Belgium",
            "Belize",
            "Benin",
            "Bhutan",
            "Bolivia",
            "Bosnia and Herzegovina",
            "Botswana",
            "Brazil",
            "Brunei",
            "Bulgaria",
            "Burkina Faso",
            "Burundi",
            "Cambodia",
            "Cameroon",
            "Canada",
            "Cape Verde",
            "Central African Republic",
            "Chad",
            "Chile",
            "China",
            "Colombi",
            "Comoros",
            "Congo (Brazzaville)",
            "Congo",
            "Costa Rica",
            "Cote d'Ivoire",
            "Croatia",
            "Cuba",
            "Cyprus",
            "Czech Republic",
            "Denmark",
            "Djibouti",
            "Dominica",
            "Dominican Republic",
            "East Timor (Timor Timur)",
            "Ecuador",
            "Egypt",
            "El Salvador",
            "Equatorial Guinea",
            "Eritrea",
            "Estonia",
            "Ethiopia",
            "Fiji",
            "Finland",
            "France",
            "Gabon",
            "Gambia, The",
            "Georgia",
            "Germany",
            "Ghana",
            "Greece",
            "Grenada",
            "Guatemala",
            "Guinea",
            "Guinea-Bissau",
            "Guyana",
            "Haiti",
            "Honduras",
            "Hungary",
            "Iceland",
            "India",
            "Indonesia",
            "Iran",
            "Iraq",
            "Ireland",
            "Israel",
            "Italy",
            "Jamaica",
            "Japan",
            "Jordan",
            "Kazakhstan",
            "Kenya",
            "Kiribati",
            "Korea, North",
            "Korea, South",
            "Kuwait",
            "Kyrgyzstan",
            "Laos",
            "Latvia",
            "Lebanon",
            "Lesotho",
            "Liberia",
            "Libya",
            "Liechtenstein",
            "Lithuania",
            "Luxembourg",
            "Macedonia",
            "Madagascar",
            "Malawi",
            "Malaysia",
            "Maldives",
            "Mali",
            "Malta",
            "Marshall Islands",
            "Mauritania",
            "Mauritius",
            "Mexico",
            "Micronesia",
            "Moldova",
            "Monaco",
            "Mongolia",
            "Morocco",
            "Mozambique",
            "Myanmar",
            "Namibia",
            "Nauru",
            "Nepal",
            "Netherlands",
            "New Zealand",
            "Nicaragua",
            "Niger",
            "Nigeria",
            "Norway",
            "Oman",
            "Pakistan",
            "Palau",
            "Panama",
            "Papua New Guinea",
            "Paraguay",
            "Peru",
            "Philippines",
            "Poland",
            "Portugal",
            "Qatar",
            "Romania",
            "Russia",
            "Rwanda",
            "Saint Kitts and Nevis",
            "Saint Lucia",
            "Saint Vincent",
            "Samoa",
            "San Marino",
            "Sao Tome and Principe",
            "Saudi Arabia",
            "Senegal",
            "Serbia and Montenegro",
            "Seychelles",
            "Sierra Leone",
            "Singapore",
            "Slovakia",
            "Slovenia",
            "Solomon Islands",
            "Somalia",
            "South Africa",
            "Spain",
            "Sri Lanka",
            "Sudan",
            "Suriname",
            "Swaziland",
            "Sweden",
            "Switzerland",
            "Syria",
            "Taiwan",
            "Tajikistan",
            "Tanzania",
            "Thailand",
            "Togo",
            "Tonga",
            "Trinidad and Tobago",
            "Tunisia",
            "Turkey",
            "Turkmenistan",
            "Tuvalu",
            "Uganda",
            "Ukraine",
            "United Arab Emirates",
            "United Kingdom",
            "United States",
            "Uruguay",
            "Uzbekistan",
            "Vanuatu",
            "Vatican City",
            "Venezuela",
            "Vietnam",
            "Yemen",
            "Zambia",
            "Zimbabwe"
        );
        $first_length = sizeof($firstname);
        $lastname_length = sizeof($lastname);
        $country_length = sizeof($countries);
        $arrAuthor = array();
        $count = 0;
        while($count < 20){
            $firstname_tmp = $firstname[rand(0, $first_length - 1)];
            $lastname_tmp = $lastname[rand(0, $lastname_length - 1)];
            $country_tmp = $countries[rand(0, $country_length - 1)];
            $arrAuthor = array('name' => $firstname_tmp.' '.$lastname_tmp,
                                'country' => $country_tmp);
            DB::table('author')->insert( $arrAuthor );
            $count++;
        }

        //Publisher seeder
        DB::table('publisher')->delete();
        $publishername = array('Vinyl and Plastic Goods Corporation','Metropolitan Sales and Rental','Irregulars Outlet','Worthwhile Activity Store',
            'Purchase Mart','Imported and Domestic Cycles','Retail Sales and Service','Designated Distributors','Brightwork Company','Immense Manufacturing Company');
        for($i = 0; $i < sizeof($publishername); $i++){
            $publisher_tmp = $publishername[$i];
            $country_tmp = $countries[rand(0, $country_length - 1)];
            $arrPublisher = array('name' => $publisher_tmp,
                'country' => $country_tmp);
            DB::table('publisher')->insert( $arrPublisher );
        }

        //Genre seeder
        DB::table('genre')->delete();
        $genrename = array(
            'Art, Architecture', 'Romance', 'Fantasy', 'Teen', 'Mystery', 'Horror', 'Historical-fiction', 'Thriller', 'Children', 'History', 'Science-fiction', 'Love', 'Computer',
            'Biography', 'Mathology'
        );
        for($i = 0; $i < sizeof($genrename); $i++){
            $arrGenre = array('name' => $genrename[$i]);
            DB::table('genre')->insert( $arrGenre );
        }

        //Book seeder
        DB::table('book')->delete();
        $arrTitle = array(
            'Harry Potter and the Chamber of Secrets',
            'The Divine Comedy by Dante',
            'Five Novels by Charles Dickens',
            'Christopher Paolini Inheritance Cycle - Brisingr',
            'The Mayor\'s Tongue by Nathaniel Rich',
            'The Chronicles of Narnia',
            'Dick Morris Hardcover Collection',
            'Seven Novels by Jules Verne'
        );
        $arrDescription = array(
            'For a long period of time books were very rare and because of such confines only some "esoteric" people could afford them. And you know what? Books always have some notes of mysticism. Just remember that special atmosphere of solitude in the library or in the old book-store, it seemed that imponderable scent of rational identity is in the air... Yeah, they are worth our admiring.
            And you know what? Books always have some notes of mysticism. Just remember that special atmosphere of solitude in the library or in the old book-store, it seemed that imponderable scent of rational identity is in the air... The unique smell of old and new pages, soft cover and so on. Yeah, they are worth our admiring. On-line book stores can offer you a great assortment of books.',
            'Yeah, they are worth our admiring. But those times are long gone and we live in 21 century and the most revolutionary thing that had happened is that books have lost their natural view. Books became more available. On-line book stores can offer you a great assortment of books. Can you imagine a world of knowledge without limits? Our business is very noble and it has many traditions.',
            'Just remember that special atmosphere of solitude in the library or in the old book-store, it seemed that imponderable scent of rational identity is in the air... The unique smell of old and new pages, soft cover and so on. Yeah, they are worth our admiring. We have tremendous variety of products, here you can find the world famous bestsellers and the books of unknown authors.',
            'Can you imagine a world of knowledge without limits? You can get everything you want and all you have to do is just visit our store. We have tremendous variety of products, here you can find the world famous bestsellers and the books of unknown authors. Actually we do understand that our activity is very important for many of you and we will never let you down. Yeah, they are worth our admiring.',
            'And you know what? Books always have some notes of mysticism. Just remember that special atmosphere of solitude in the library or in the old book-store, it seemed that imponderable scent of rational identity is in the air... The unique smell of old and new pages, soft cover and so on. Yeah, they are worth our admiring. On-line book stores can offer you a great assortment of books.',
            'For a long period of time books were very rare and because of such confines only some "esoteric" people could afford them. And you know what? Books always have some notes of mysticism. Just remember that special atmosphere of solitude in the library or in the old book-store, it seemed that imponderable scent of rational identity is in the air... Yeah, they are worth our admiring.',
            'Well, reading books as a hobby was always a noble, pleasant and very useful kind of activity. It gives knowledge, excerpts on the process of development of your personality. For a long period of time books were very rare and because of such confines only some "esoteric" people could afford them. And you know what? Books always have some notes of mysticism.',
            'But those times are long gone and we live in 21 century and the most revolutionary thing that had happened is that books have lost their natural view. Books became more available. On-line book stores can offer you a great assortment of books. Can you imagine a world of knowledge without limits? You can get everything you want and all you have to do is just visit our store.'
        );
        $count = 0;
        while ($count < 8) {
            $isbn1 = (string)rand(100000, 999999);
            $isbn2 = (string)rand(1000000, 9999999);
            $isbn = $isbn1.$isbn2;
            $price = rand(100, 300) * 1000;
            $now = date('Y-m-d H:i:s');
            $arrBook = array(
                'title' => $arrTitle[$count],
                'author_id' => rand(1, 20),
                'publisher_id' => rand(1, 10),
                'genre_id' => rand(1, 14),
                'image' => 'abc.jpg',
                'isbn' => $isbn,
                'description_short' => $arrDescription[$count],
                'description' => '',
                'price' => $price,
                'sale' => 0,
                'quantity' => rand(10, 50)
            );
            DB::table('book')->insert( $arrBook );
            $count++;
        }

        //Admin seeder
        DB::table('users')->delete();
        $arrUser = array(
            'username' => 'admin',
            'password' => Hash::make(123456),
            'email' => 'phucanh48@gmail.com',
            'userable_id' => '',
            'userable_type' => 'admin',
            'remember_token' => ''
        );
        DB::table('users')->insert( $arrUser );

        //Genre detail seeder
        DB::table('genre_detail')->delete();
        $arrGenreDetail = array(
            array(
                'name' => 'Etur adipisicing eli',
                'genre_id' => 1
            ),
            array(
                'name' => 'Sed do eiusmod tempor',
                'genre_id' => 1
            )
        );
        DB::table('genre_detail')->insert($arrGenreDetail);
    }
}
