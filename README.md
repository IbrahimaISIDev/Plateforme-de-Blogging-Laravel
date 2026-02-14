# 📝 Plateforme de Blogging - Laravel 11

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

Une plateforme de blogging moderne et complète développée avec Laravel 11, permettant la gestion et la publication d'articles organisés par catégories.

## 🎯 Fonctionnalités

### Interface Publique
- ✅ Affichage des articles publiés
- ✅ Consultation détaillée des articles
- ✅ Filtrage des articles par catégorie
- ✅ Navigation intuitive et responsive
- ✅ Design moderne avec Tailwind CSS

### Panel d'Administration
- ✅ **Gestion des catégories** (CRUD complet)
  - Création, modification et suppression
  - Liste avec compteur d'articles
  - Génération automatique des slugs
  
- ✅ **Gestion des articles** (CRUD complet)
  - Création et édition d'articles
  - Système de brouillon/publication
  - Association aux catégories
  - Génération automatique des slugs et extraits
  - Suppression sécurisée

### Fonctionnalités Techniques
- 🔒 Validation des formulaires
- 📊 Pagination des résultats
- 🔗 Relations Eloquent optimisées
- 🎨 Interface responsive (mobile-first)
- ⚡ Performance optimisée avec Eager Loading
- 🛡️ Protection CSRF

## 📋 Prérequis

Avant de commencer, assurez-vous d'avoir installé :

- **PHP** >= 8.2
- **Composer** >= 2.6
- **Node.js** >= 18.x
- **NPM** >= 9.x
- **MySQL** >= 8.0 ou **PostgreSQL** >= 13

## 🚀 Installation

### 1. Cloner le projet

```bash
git clone https://github.com/votre-username/plateforme-blogging.git
cd plateforme-blogging
```

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Installer les dépendances JavaScript

```bash
npm install
```

### 4. Configuration de l'environnement

Copier le fichier `.env.example` et le renommer en `.env` :

```bash
cp .env.example .env
```

Générer la clé d'application :

```bash
php artisan key:generate
```

### 5. Configurer la base de données

Modifier le fichier `.env` avec vos paramètres de base de données :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=plateforme_blogging
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe
```

Créer la base de données :

```sql
CREATE DATABASE plateforme_blogging CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Exécuter les migrations

```bash
php artisan migrate
```

### 7. Peupler la base de données (optionnel)

Pour ajouter des données de test :

```bash
php artisan db:seed
```

Ou pour réinitialiser complètement :

```bash
php artisan migrate:fresh --seed
```

### 8. Compiler les assets

**Mode développement** (avec rechargement automatique) :

```bash
npm run dev
```

**Mode production** :

```bash
npm run build
```

### 9. Démarrer le serveur

```bash
php artisan serve
```

L'application sera accessible à l'adresse : **http://localhost:8000**

## 📁 Structure du Projet

```
plateforme-blogging/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── HomeController.php          # Affichage public
│   │       ├── CategoryController.php      # Gestion catégories
│   │       └── ArticleController.php       # Gestion articles
│   │
│   └── Models/
│       ├── Category.php                    # Modèle Catégorie
│       └── Article.php                     # Modèle Article
│
├── database/
│   ├── migrations/
│   │   ├── xxxx_create_categories_table.php
│   │   └── xxxx_create_articles_table.php
│   │
│   └── seeders/
│       ├── CategorySeeder.php
│       └── ArticleSeeder.php
│
├── resources/
│   ├── css/
│   │   └── app.css                         # Styles Tailwind
│   │
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php               # Layout principal
│       │
│       ├── categories/                     # Vues catégories
│       ├── articles/                       # Vues articles
│       ├── home.blade.php                  # Page d'accueil
│       ├── article.blade.php               # Détail article
│       └── category-articles.blade.php     # Articles par catégorie
│
└── routes/
    └── web.php                             # Routes de l'application
```

## 🗄️ Base de Données

### Schéma

Le projet utilise deux tables principales :

**Table `categories`**
- `id` : Identifiant unique
- `name` : Nom de la catégorie (unique)
- `slug` : URL-friendly slug (unique)
- `description` : Description (optionnel)
- Timestamps

**Table `articles`**
- `id` : Identifiant unique
- `category_id` : Clé étrangère vers categories
- `title` : Titre de l'article
- `slug` : URL-friendly slug (unique)
- `content` : Contenu de l'article
- `excerpt` : Extrait/résumé (optionnel)
- `is_published` : Statut de publication (booléen)
- `published_at` : Date de publication
- Timestamps

### Relations

- Une **catégorie** a plusieurs **articles** (One-to-Many)
- Un **article** appartient à une **catégorie** (Belongs-to)

## 🛣️ Routes

### Routes Publiques

| Méthode | URI | Action | Description |
|---------|-----|--------|-------------|
| GET | `/` | home | Page d'accueil |
| GET | `/article/{slug}` | article.show | Détail d'un article |
| GET | `/categorie/{slug}` | category.articles | Articles par catégorie |

### Routes d'Administration

| Méthode | URI | Action | Description |
|---------|-----|--------|-------------|
| GET | `/admin/categories` | categories.index | Liste des catégories |
| GET | `/admin/categories/create` | categories.create | Créer une catégorie |
| POST | `/admin/categories` | categories.store | Enregistrer une catégorie |
| GET | `/admin/categories/{id}` | categories.show | Détail d'une catégorie |
| GET | `/admin/categories/{id}/edit` | categories.edit | Modifier une catégorie |
| PUT | `/admin/categories/{id}` | categories.update | Mettre à jour une catégorie |
| DELETE | `/admin/categories/{id}` | categories.destroy | Supprimer une catégorie |
| | | | |
| GET | `/admin/articles` | articles.index | Liste des articles |
| GET | `/admin/articles/create` | articles.create | Créer un article |
| POST | `/admin/articles` | articles.store | Enregistrer un article |
| GET | `/admin/articles/{id}` | articles.show | Détail d'un article |
| GET | `/admin/articles/{id}/edit` | articles.edit | Modifier un article |
| PUT | `/admin/articles/{id}` | articles.update | Mettre à jour un article |
| DELETE | `/admin/articles/{id}` | articles.destroy | Supprimer un article |
| POST | `/admin/articles/{id}/toggle-publish` | articles.toggle-publish | Publier/Dépublier |

## 💻 Utilisation

### Créer une catégorie

1. Accédez à `/admin/categories`
2. Cliquez sur "Nouvelle catégorie"
3. Remplissez le formulaire (nom et description)
4. Cliquez sur "Créer la catégorie"

### Créer un article

1. Accédez à `/admin/articles`
2. Cliquez sur "Nouvel article"
3. Remplissez le formulaire :
   - Titre
   - Catégorie
   - Extrait (optionnel)
   - Contenu
   - Cochez "Publier immédiatement" si souhaité
4. Cliquez sur "Créer l'article"

### Publier/Dépublier un article

Depuis la liste des articles (`/admin/articles`) :
- Cliquez sur "📤 Publier" pour publier un brouillon
- Cliquez sur "📥 Dépublier" pour retirer un article publié

### Consulter les articles

- Page d'accueil : `/` - Affiche tous les articles publiés
- Par catégorie : `/categorie/{slug}` - Filtre par catégorie
- Détail : `/article/{slug}` - Affiche un article complet

## 🧪 Tests

### Lancer les tests

```bash
php artisan test
```

### Tests manuels recommandés

- ✅ Créer, modifier et supprimer une catégorie
- ✅ Créer un article en brouillon
- ✅ Publier un brouillon
- ✅ Vérifier qu'un brouillon n'apparaît pas sur la page publique
- ✅ Filtrer les articles par catégorie
- ✅ Tester la pagination
- ✅ Vérifier la validation des formulaires (champs requis)
- ✅ Tester la suppression avec articles associés

## 🔧 Configuration

### Variables d'environnement importantes

```env
# Application
APP_NAME="Plateforme Blogging"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Base de données
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=plateforme_blogging
DB_USERNAME=root
DB_PASSWORD=

# Timezone
APP_TIMEZONE=Africa/Dakar
```

### Compilation des assets

**Développement** :
```bash
npm run dev
# Ou avec rechargement automatique
npm run dev -- --host
```

**Production** :
```bash
npm run build
```

## 🚀 Déploiement

### Préparation pour la production

```bash
# 1. Optimiser l'autoloader
composer install --optimize-autoloader --no-dev

# 2. Mettre en cache la configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Compiler les assets
npm run build

# 4. Configurer .env pour production
APP_ENV=production
APP_DEBUG=false
```

### Permissions

Assurez-vous que les dossiers suivants sont accessibles en écriture :

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

## 📚 Technologies Utilisées

- **Backend** : Laravel 11.x
- **Frontend** : Blade Templates + Tailwind CSS 3.x
- **Base de données** : MySQL 8.x
- **Build Tool** : Vite
- **PHP** : 8.2+
- **Architecture** : MVC (Model-View-Controller)

## 🎨 Design

Le projet utilise **Tailwind CSS** pour un design moderne et responsive :
- Design mobile-first
- Interface utilisateur intuitive
- Composants réutilisables
- Palette de couleurs cohérente (indigo comme couleur principale)

## 🛡️ Sécurité

- ✅ Protection CSRF sur tous les formulaires
- ✅ Validation des données côté serveur
- ✅ Eloquent ORM (protection contre SQL injection)
- ✅ Mass assignment protection
- ✅ Variables d'environnement pour données sensibles

## 🔄 Commandes Artisan Utiles

```bash
# Migrations
php artisan migrate                  # Exécuter les migrations
php artisan migrate:fresh            # Réinitialiser la BDD
php artisan migrate:fresh --seed     # Réinitialiser avec données test

# Cache
php artisan cache:clear              # Vider le cache
php artisan config:clear             # Vider le cache de config
php artisan route:clear              # Vider le cache des routes
php artisan view:clear               # Vider le cache des vues

# Seeders
php artisan db:seed                  # Exécuter tous les seeders
php artisan db:seed --class=CategorySeeder  # Seeder spécifique

# Maintenance
php artisan down                     # Mode maintenance ON
php artisan up                       # Mode maintenance OFF

# Routes
php artisan route:list               # Lister toutes les routes

# Optimisation
php artisan optimize                 # Optimiser l'application
php artisan optimize:clear           # Supprimer les optimisations
```

## 📝 Bonnes Pratiques

Le projet suit les conventions et bonnes pratiques Laravel :

- ✅ **Respect de l'architecture MVC**
- ✅ **Eloquent ORM** pour les interactions base de données
- ✅ **Route Model Binding** pour simplifier les contrôleurs
- ✅ **Form Request Validation** pour la validation
- ✅ **Blade Components** pour la réutilisabilité
- ✅ **Scopes** pour les requêtes réutilisables
- ✅ **Eager Loading** pour optimiser les performances
- ✅ **Messages flash** pour le feedback utilisateur
- ✅ **Slugs** pour des URLs propres et SEO-friendly

## 🐛 Dépannage

### Erreur de connexion à la base de données

```bash
# Vérifier les credentials dans .env
# Vérifier que MySQL est démarré
# Vider le cache de configuration
php artisan config:clear
```

### Les assets ne se chargent pas

```bash
# Recompiler les assets
npm run build

# Ou en mode dev
npm run dev
```

### Erreur 500

```bash
# Vérifier les permissions
chmod -R 775 storage bootstrap/cache

# Vérifier les logs
tail -f storage/logs/laravel.log

# Vider tous les caches
php artisan optimize:clear
```

### Les routes ne fonctionnent pas

```bash
# Vérifier les routes
php artisan route:list

# Vider le cache des routes
php artisan route:clear
```

## 🤝 Contribution

Les contributions sont les bienvenues ! Voici comment contribuer :

1. Fork le projet
2. Créez une branche pour votre fonctionnalité (`git checkout -b feature/AmazingFeature`)
3. Committez vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Poussez vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrez une Pull Request

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 👤 Auteur

**Votre Nom**
- GitHub: [@votre-username](https://github.com/votre-username)
- Email: votre.email@example.com

## 🙏 Remerciements

- [Laravel](https://laravel.com) - Framework PHP élégant
- [Tailwind CSS](https://tailwindcss.com) - Framework CSS utility-first
- [Blade](https://laravel.com/docs/blade) - Moteur de templates Laravel

## 📞 Support

Pour toute question ou problème :
- Ouvrir une [issue](https://github.com/votre-username/plateforme-blogging/issues)
- Consulter la [documentation Laravel](https://laravel.com/docs/11.x)

---

**Développé avec ❤️ en utilisant Laravel 11**
# Plateforme-de-Blogging-Laravel
