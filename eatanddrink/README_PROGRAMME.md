# 📅 Page Programme - Eat&Drink Festival

## 🎯 Fonctionnalités Implémentées

### ✅ Page Programme Complète
- **Timeline interactive** avec 3 jours de programme
- **Navigation par onglets** entre les jours
- **Événements détaillés** avec horaires, lieux et descriptions
- **Catégories d'événements** (Atelier, Spectacle, Dégustation, etc.)
- **Actions interactives** (Ajouter au calendrier, S'inscrire)

### ✅ Système de Calendrier Personnel
- **Ajout d'événements** au calendrier personnel
- **Sauvegarde en session** Laravel + localStorage
- **Prévention des doublons** d'événements
- **Notifications** de confirmation

### ✅ Système d'Inscription aux Ateliers
- **Inscription en temps réel** aux ateliers
- **Validation côté serveur** avec Laravel
- **Gestion des places limitées**
- **Notifications de statut**

### ✅ Interface Responsive
- **Design adaptatif** mobile/desktop
- **Timeline responsive** qui s'adapte aux petits écrans
- **Animations fluides** et transitions
- **Design cohérent** avec le reste du site

## 🛠️ Architecture Technique

### Contrôleurs
- `PublicController@programme` - Affichage de la page programme
- `WorkshopController` - Gestion des ateliers et inscriptions

### Routes
```php
Route::get('/programme', [PublicController::class, 'programme'])->name('programme');
Route::get('/ateliers', [WorkshopController::class, 'index'])->name('workshops.index');
Route::post('/ateliers/inscription', [WorkshopController::class, 'register'])->name('workshops.register');
Route::post('/calendrier/ajouter', [WorkshopController::class, 'addToCalendar'])->name('calendar.add');
```

### Vues
- `resources/views/programme.blade.php` - Page principale du programme
- Utilise le layout `layouts/app.blade.php`

### Assets
- **CSS** : Styles pour timeline, onglets, événements
- **JavaScript** : Interactivité, gestion du calendrier, inscriptions

## 📋 Événements du Programme

### Vendredi 15 Mars
- **10:00** - Cérémonie d'ouverture
- **12:00** - Masterclass Pizza (Atelier - 20 places)
- **15:00** - Concert Jazz & Food
- **18:00** - Dégustation de vins (Atelier - 15 places)

### Samedi 16 Mars
- **09:00** - Petit-déjeuner gourmet
- **11:00** - Concours de cuisine
- **14:00** - Atelier Sushi (Atelier - 25 places)
- **17:00** - Spectacle culinaire

### Dimanche 17 Mars
- **10:00** - Atelier Pâtisserie (Atelier - 18 places)
- **13:00** - Remise des prix
- **15:00** - Grande fête de clôture

## 🎨 Design System

### Couleurs
- **Orange primaire** : #FF6B35
- **Orange secondaire** : #F7931E
- **Accent** : #FFD23F
- **Bleu** : #219EBC
- **Vert** : #00B894

### Typographie
- **Titres** : Poppins (700)
- **Corps** : Inter (400-600)

### Composants
- **Timeline** : Ligne centrale avec marqueurs
- **Onglets** : Navigation entre les jours
- **Cartes événements** : Design moderne avec ombres
- **Boutons** : Actions primaires et secondaires

## 🔧 Fonctionnalités JavaScript

### Gestion des Onglets
```javascript
function setupDayTabs() {
    // Navigation entre les jours du programme
}
```

### Calendrier Personnel
```javascript
function addToCalendar(day, time, event) {
    // Ajout d'événements avec validation
}
```

### Inscriptions aux Ateliers
```javascript
function registerWorkshop(workshopId) {
    // Inscription via API Laravel
}
```

### Notifications
```javascript
function showNotification(message, type) {
    // Système de notifications toast
}
```

## 📱 Responsive Design

### Desktop (>768px)
- Timeline centrée avec événements alternés
- Onglets horizontaux
- Cartes événements larges

### Mobile (≤768px)
- Timeline alignée à gauche
- Onglets verticaux
- Cartes événements pleine largeur

## 🚀 Utilisation

### Accès à la Page
```
http://localhost:8000/programme
```

### Navigation
- Cliquer sur les onglets pour changer de jour
- Cliquer sur "Ajouter au calendrier" pour sauvegarder un événement
- Cliquer sur "S'inscrire" pour les ateliers payants

### Fonctionnalités
- **Calendrier personnel** : Événements sauvegardés en session
- **Inscriptions** : Gestion des places limitées
- **Notifications** : Feedback utilisateur en temps réel

## 🔄 Intégration Laravel

### Session Management
- Calendrier utilisateur stocké en session
- Inscriptions aux ateliers persistantes
- CSRF protection pour toutes les requêtes

### Validation
- Validation côté serveur pour les inscriptions
- Prévention des doublons d'événements
- Gestion des erreurs avec fallback

### Performance
- Assets compilés avec Vite
- CSS et JS optimisés
- Chargement asynchrone des données

## 📈 Prochaines Étapes

### Améliorations Possibles
1. **Base de données** : Stocker les événements et inscriptions
2. **Authentification** : Liens avec les comptes utilisateurs
3. **Notifications email** : Confirmations d'inscription
4. **Paiement** : Intégration pour les ateliers payants
5. **Partage** : Partage du calendrier personnel

### Fonctionnalités Avancées
- **Recherche** d'événements
- **Filtres** par catégorie
- **Export** du calendrier (iCal)
- **Rappels** automatiques
- **Statistiques** de participation

---

**Statut** : ✅ Complété et fonctionnel  
**Testé** : ✅ Navigation, calendrier, inscriptions  
**Responsive** : ✅ Mobile et desktop  
**Performance** : ✅ Assets optimisés 