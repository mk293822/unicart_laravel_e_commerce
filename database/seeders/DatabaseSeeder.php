<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\OrderedProducts;
use App\Models\Orders;
use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $products = [
            // Electronics
            'Electronics' => [
                'iPhone 15 Pro Max',
                'Samsung Galaxy S23 Ultra',
                'Sony PlayStation 5',
                'Apple MacBook Pro M2',
                'Bose QuietComfort 45',
                'Sony WH-1000XM5',
                'Apple AirPods Pro 2nd Gen',
                'GoPro Hero 11',
                'Canon EOS R5 Camera',
                'DJI Mini 3 Pro Drone',
                'Fitbit Charge 5',
                'Garmin Forerunner 945',
                'Apple Watch Ultra',
                'Sony 4K TV',
                'LG OLED TV',
                'Nintendo Switch OLED',
                'Acer Predator Helios 300 Gaming Laptop',
                'HP Spectre x360 Laptop',
                'Logitech G Pro X Gaming Headset',
                'Razer BlackWidow V3 Mechanical Keyboard',
            ],

            // Fashion
            'Fashion' => [
                'Levi’s 511 Slim Fit Jeans',
                'Nike Air Force 1',
                'Adidas Ultraboost 22',
                'Puma Suede Classic Sneakers',
                'Vans Old Skool',
                'H&M Wool Blend Coat',
                'Zara Floral Print Dress',
                'Uniqlo Ultra Light Down Jacket',
                'The North Face Resolve Jacket',
                'Tommy Hilfiger Men’s Dress Shirt',
                'Ralph Lauren Polo Shirt',
                'Calvin Klein Leather Belt',
                'Michael Kors Leather Wallet',
                'Fossil Gen 6 Smartwatch',
                'Ray-Ban Aviator Sunglasses',
                'Gucci Black Leather Handbag',
                'Louis Vuitton Monogram Canvas Bag',
                'Timberland 6-Inch Premium Boots',
                'UGG Classic Short Boots',
                'Converse Chuck Taylor High Tops',
            ],

            // Home & Furniture
            'Home & Furniture' => [
                'IKEA Ektorp Sofa',
                'IKEA Hemnes Dresser',
                'IKEA Malm Bed Frame',
                'West Elm Mid-Century Armchair',
                'Pottery Barn Farmhouse Dining Table',
                'Crate & Barrel Sofa',
                'Ashley Furniture Coffee Table',
                'Wayfair White Shag Area Rug',
                'AmazonBasics 5-Shelf Bookcase',
                'Sealy Posturepedic Mattress',
                'Tempur-Pedic Cloud Mattress',
                'Casper Sleep Mattress',
                'Breville Barista Express Espresso Machine',
                'KitchenAid Stand Mixer',
                'Cuisinart 12-Piece Cookware Set',
                'Ninja Professional Blender',
                'Vitamix A3500 Blender',
                'Hamilton Beach Coffee Maker',
                'Keurig K-Elite Coffee Machine',
                'Dyson V11 Cordless Vacuum',
            ],

            // Sports & Outdoors
            'Sports & Outdoors' => [
                'Nike Air Zoom Pegasus 39',
                'Adidas UltraBoost 22',
                'Under Armour Charged Assert 9',
                'Columbia Waterproof Jacket',
                'Patagonia Black Hole Duffel Bag',
                'YETI Rambler Bottle',
                'Coleman Sundome Tent',
                'REI Co-op Half Dome Tent',
                'The North Face Base Camp Duffel',
                'Osprey Farpoint 55 Backpack',
                'Garmin Forerunner 945 Smartwatch',
                'Therm-a-Rest NeoAir Sleeping Pad',
                'CamelBak Hydration Pack',
                'Black Diamond Spot Headlamp',
                'REI Co-op Flash Pack',
                'Teton Sports Celsius Sleeping Bag',
                'Hydro Flask Wide Mouth Bottle',
                'Adidas Terrex GTX Hiking Shoes',
                'Garmin Edge 530 Cycling Computer',
                'Schwinn Discover Hybrid Bike',
            ],

            // Health & Beauty
            'Health & Beauty' => [
                'Neutrogena Hydro Boost Water Gel',
                'Olay Regenerist Micro-Sculpting Cream',
                'La Mer Crème de la Mer',
                'Tatcha Dewy Skin Cream',
                'Sunday Riley Vitamin C Serum',
                'Estée Lauder Advanced Night Repair',
                'Clinique Moisture Surge',
                'Glossier Cloud Paint Blush',
                'MAC Cosmetics Studio Fix Foundation',
                'Fenty Beauty Pro Filt\'r Foundation',
                'Dyson Supersonic Hair Dryer',
                'BabylissPRO Nano Titanium Iron',
                'GHD Platinum+ Styler',
                'T3 Lucea Professional Iron',
                'Fresh Soy Face Cleanser',
                'CeraVe Hydrating Facial Cleanser',
                'Drunk Elephant Babyfacial',
                'Mario Badescu Facial Spray',
                'LOréal Revitalift Brightening Pads',
                'E.l.f. Poreless Putty Primer',
            ],

            // Toys & Games
            'Toys & Games' => [
                'LEGO Star Wars The Mandalorian',
                'Barbie Dreamhouse',
                'Play-Doh Classic Colors Set',
                'Nerf N-Strike Blaster',
                'Monopoly Classic',
                'Jenga Classic',
                'Hungry Hungry Hippos',
                'Uno Card Game',
                'The Game of Life',
                'Settlers of Catan',
                'Risk Board Game',
                'Pokémon Sword for Nintendo Switch',
                'Super Mario Odyssey',
                'Beyblade Burst Turbo',
                'VTech Learning Desk',
                'Fisher-Price Laugh & Learn Puppy',
                'LEGO Creator Camper Van',
                'Hot Wheels 50-Car Pack',
                'Little Tikes Basketball Set',
                'Melissa & Doug Wooden Railway Set',
            ],

            // Books & Stationery
            'Books & Stationery' => [
                'The Catcher in the Rye',
                '1984 by George Orwell',
                'Harry Potter and the Sorcerer’s Stone',
                'The Great Gatsby',
                'To Kill a Mockingbird',
                'The Hobbit',
                'The Lord of the Rings',
                'The Chronicles of Narnia',
                'Brave New World',
                'The Alchemist by Paulo Coelho',
                'The Diary of a Young Girl by Anne Frank',
                'War and Peace',
                'The Power of Now',
                'Where the Crawdads Sing',
                'Becoming by Michelle Obama',
                'The Silent Patient',
                'Atomic Habits',
                'Outliers by Malcolm Gladwell',
                'The Subtle Art of Not Giving a F*ck',
                'The Book Thief',
            ],

            // Automotive
            'Automotive' => [
                'Michelin Pilot Sport 4 Tires',
                'Bosch Icon Wiper Blades',
                'Meguiar’s Ultimate Liquid Wax',
                'Valvoline Full Synthetic Oil',
                'K&N High-Flow Air Filter',
                'Turtle Wax Ceramic Spray',
                'DEWALT Cordless Impact Wrench',
                'Thule Roof Box',
                'Honda Civic Floor Mats',
                'Yakima Roof Rack',
                'WeatherTech Floor Mats',
                'Garmin DriveSmart GPS',
                'Armor All Interior Cleaner',
                '3M Headlight Restoration Kit',
                'Optima RedTop Battery',
                'LED Car Headlights',
                'Blaupunkt Bluetooth Car Stereo',
                'CTEK Battery Charger',
                'Craftsman Cordless Drill',
                'Magellan RoadMate GPS',
            ],

            // Food & Beverages
            'Food & Beverages' => [
                'Red Bull Energy Drink',
                'Coca-Cola',
                'Pepsi',
                'Tropicana Orange Juice',
                'Fanta Orange Soda',
                'Starbucks Caramel Macchiato',
                'Dunkin\' Donuts Coffee',
                'Lay’s Classic Chips',
                'Pringles Original Chips',
                'Doritos Nacho Cheese',
                'Reese\'s Peanut Butter Cups',
                'Hershey’s Milk Chocolate',
                'Kit Kat Bars',
                'Cornflakes Cereal',
                'Cheerios',
                'Quaker Oats',
                'Nutella Spread',
                'Planters Cashews',
                'M&M’s Milk Chocolate',
                'Smartfood White Cheddar Popcorn',
            ],

            // Baby & Kids
            'Baby & Kids' => [
                'Pampers Swaddlers Diapers',
                'Fisher-Price Laugh & Learn Smart Stages Puppy',
                'VTech Learning Desk',
                'Graco SnugRide Car Seat',
                'Play-Doh Classic Colors Set',
                'Carter’s Baby Onesies',
                'Step2 My First Basketball Hoop',
                'LEGO Duplo Sets',
                'Melissa & Doug Wooden Puzzles',
                'Skip Hop Zoo Backpack',
                'Fisher-Price Rock-a-Stack',
                'VTech Touch and Learn Activity Desk',
                'Chicco KeyFit 30 Infant Car Seat',
                'Boppy Nursing Pillow',
                'Gerber Baby Food',
                'Luvs Diapers',
                'Huggies Baby Wipes',
                'Tommee Tippee Closer to Nature Bottle',
                'Munchkin White Hot Safety Spoons',
                'Graco Pack',
                'Play Playard',
            ],
        ];

        User::factory()->create([
            'name' => 'Min Khant Thaw',
            'email' => 'mkt293822@gmail.com',
            'password' => bcrypt('mkt293822'),
        ]);

        $faker = Faker::create();


        foreach ($products as $category => $product_names) {
            $description = $faker->sentence(10);
            $category = Categories::create([
                "name" => $category,
                "slug" => Str::slug($category),
                "description" => $description,
            ]);
            foreach ($product_names as $product_name) {
                Products::factory(1)->create([
                    'category_id' => $category->id,
                    'name' => $product_name,
                    'slug' => Str::slug($product_name),
                ]);
            }
        }
    }
}
