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
        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica",
            "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain",
            "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina",
            "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso",
            "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile",
            "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the",
            "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti",
            "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia",
            "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana",
            "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece",
            "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands",
            "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)",
            "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati",
            "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia",
            "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau",
            "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands",
            "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco",
            "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles",
            "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway",
            "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal",
            "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia",
            "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles",
            "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa",
            "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan",
            "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China",
            "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey",
            "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States",
            "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)",
            "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
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
            'Romance', 'Fantasy', 'Teen', 'Mystery', 'Horror', 'Historical-fiction', 'Thriller', 'Children', 'History', 'Science-fiction', 'Love', 'Computer',
            'Biography', 'Mathology'
        );
        for($i = 0; $i < sizeof($genrename); $i++){
            $arrGenre = array('name' => $genrename[$i]);
            DB::table('genre')->insert( $arrGenre );
        }

        //Book seeder
        DB::table('book')->delete();

    }
}
