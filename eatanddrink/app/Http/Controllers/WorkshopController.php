<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WorkshopController extends Controller
{
    /**
     * Afficher la liste des ateliers disponibles
     */
    public function index()
    {
        $workshops = [
            [
                'id' => 'pizza-masterclass',
                'name' => 'Masterclass Pizza',
                'day' => 'Vendredi 15 Mars',
                'time' => '12:00',
                'duration' => '2h00',
                'location' => 'Zone ateliers',
                'capacity' => 20,
                'price' => 25,
                'description' => 'Apprenez à faire une vraie pizza napolitaine avec nos maîtres pizzaiolos italiens.',
                'instructor' => 'Chef Marco Rossi',
                'category' => 'Cuisine italienne'
            ],
            [
                'id' => 'wine-tasting',
                'name' => 'Dégustation de vins',
                'day' => 'Vendredi 15 Mars',
                'time' => '18:00',
                'duration' => '1h30',
                'location' => 'Cave à vins',
                'capacity' => 15,
                'price' => 35,
                'description' => 'Découverte des vins du monde avec des sommeliers experts et accords mets-vins.',
                'instructor' => 'Sommelier Pierre Dubois',
                'category' => 'Dégustation'
            ],
            [
                'id' => 'sushi-workshop',
                'name' => 'Atelier Sushi',
                'day' => 'Samedi 16 Mars',
                'time' => '14:00',
                'duration' => '2h30',
                'location' => 'Zone ateliers',
                'capacity' => 25,
                'price' => 30,
                'description' => 'Apprenez à préparer des sushis et makis avec nos experts japonais.',
                'instructor' => 'Chef Yuki Tanaka',
                'category' => 'Cuisine japonaise'
            ],
            [
                'id' => 'pastry-workshop',
                'name' => 'Atelier Pâtisserie',
                'day' => 'Dimanche 17 Mars',
                'time' => '10:00',
                'duration' => '2h00',
                'location' => 'Zone ateliers',
                'capacity' => 18,
                'price' => 28,
                'description' => 'Créez vos propres pâtisseries avec nos chefs pâtissiers français.',
                'instructor' => 'Chef Marie Laurent',
                'category' => 'Pâtisserie'
            ]
        ];

        return view('workshops.index', compact('workshops'));
    }

    /**
     * S'inscrire à un atelier
     */
    public function register(Request $request)
    {
        $request->validate([
            'workshop_id' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
        ]);

        $workshopId = $request->workshop_id;
        
        // Simuler l'inscription (dans un vrai projet, on sauvegarderait en base)
        $registration = [
            'workshop_id' => $workshopId,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'registered_at' => now(),
        ];

        // Stocker temporairement en session
        $registrations = Session::get('workshop_registrations', []);
        $registrations[] = $registration;
        Session::put('workshop_registrations', $registrations);

        return response()->json([
            'success' => true,
            'message' => 'Inscription réussie ! Vous recevrez un email de confirmation.',
            'registration' => $registration
        ]);
    }

    /**
     * Obtenir les détails d'un atelier
     */
    public function show($id)
    {
        $workshops = [
            'pizza-masterclass' => [
                'id' => 'pizza-masterclass',
                'name' => 'Masterclass Pizza',
                'day' => 'Vendredi 15 Mars',
                'time' => '12:00',
                'duration' => '2h00',
                'location' => 'Zone ateliers',
                'capacity' => 20,
                'price' => 25,
                'description' => 'Apprenez à faire une vraie pizza napolitaine avec nos maîtres pizzaiolos italiens.',
                'instructor' => 'Chef Marco Rossi',
                'category' => 'Cuisine italienne',
                'materials' => ['Farine 00', 'Mozzarella di Bufala', 'Sauce tomate', 'Basilic frais'],
                'requirements' => ['Aucun prérequis', 'Équipement fourni', 'Tablier inclus']
            ],
            'wine-tasting' => [
                'id' => 'wine-tasting',
                'name' => 'Dégustation de vins',
                'day' => 'Vendredi 15 Mars',
                'time' => '18:00',
                'duration' => '1h30',
                'location' => 'Cave à vins',
                'capacity' => 15,
                'price' => 35,
                'description' => 'Découverte des vins du monde avec des sommeliers experts et accords mets-vins.',
                'instructor' => 'Sommelier Pierre Dubois',
                'category' => 'Dégustation',
                'materials' => ['Verres de dégustation', 'Carte des vins', 'Fromages d\'accompagnement'],
                'requirements' => ['Âge minimum 18 ans', 'Palais curieux', 'Aucune expérience requise']
            ],
            'sushi-workshop' => [
                'id' => 'sushi-workshop',
                'name' => 'Atelier Sushi',
                'day' => 'Samedi 16 Mars',
                'time' => '14:00',
                'duration' => '2h30',
                'location' => 'Zone ateliers',
                'capacity' => 25,
                'price' => 30,
                'description' => 'Apprenez à préparer des sushis et makis avec nos experts japonais.',
                'instructor' => 'Chef Yuki Tanaka',
                'category' => 'Cuisine japonaise',
                'materials' => ['Riz vinaigré', 'Poisson frais', 'Nori', 'Wasabi', 'Gingembre'],
                'requirements' => ['Aucun prérequis', 'Équipement fourni', 'Ingrédients inclus']
            ],
            'pastry-workshop' => [
                'id' => 'pastry-workshop',
                'name' => 'Atelier Pâtisserie',
                'day' => 'Dimanche 17 Mars',
                'time' => '10:00',
                'duration' => '2h00',
                'location' => 'Zone ateliers',
                'capacity' => 18,
                'price' => 28,
                'description' => 'Créez vos propres pâtisseries avec nos chefs pâtissiers français.',
                'instructor' => 'Chef Marie Laurent',
                'category' => 'Pâtisserie',
                'materials' => ['Farine T55', 'Beurre AOP', 'Œufs frais', 'Sucre vanillé', 'Chocolat noir'],
                'requirements' => ['Aucun prérequis', 'Équipement fourni', 'Emballages fournis']
            ]
        ];

        if (!isset($workshops[$id])) {
            abort(404);
        }

        $workshop = $workshops[$id];
        return view('workshops.show', compact('workshop'));
    }

    /**
     * Obtenir le calendrier utilisateur
     */
    public function calendar()
    {
        $calendar = Session::get('user_calendar', []);
        return response()->json($calendar);
    }

    /**
     * Ajouter un événement au calendrier
     */
    public function addToCalendar(Request $request)
    {
        $request->validate([
            'day' => 'required|string',
            'time' => 'required|string',
            'event' => 'required|string',
        ]);

        $event = [
            'day' => $request->day,
            'time' => $request->time,
            'event' => $request->event,
            'added_at' => now()->toISOString(),
        ];

        $calendar = Session::get('user_calendar', []);
        
        // Vérifier si l'événement n'est pas déjà présent
        $exists = collect($calendar)->contains(function ($item) use ($event) {
            return $item['day'] === $event['day'] && 
                   $item['time'] === $event['time'] && 
                   $item['event'] === $event['event'];
        });

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Cet événement est déjà dans votre calendrier'
            ]);
        }

        $calendar[] = $event;
        Session::put('user_calendar', $calendar);

        return response()->json([
            'success' => true,
            'message' => $event['event'] . ' ajouté à votre calendrier !',
            'calendar' => $calendar
        ]);
    }
} 
 
 