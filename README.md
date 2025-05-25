# Judges Scoring System

A Laravel-based web application for managing judges and scoring participants in competitions or events. The system provides a real-time scoreboard, admin panel for judge management, and individual judge portals for scoring participants.

## Features

-   **Public Scoreboard**: Real-time leaderboard showing participants ranked by total score
-   **Admin Panel**: Create and manage judges with unique usernames and display names
-   **Judge Portal**: Individual interfaces for judges to score participants (1-100 points)
-   **Real-time Updates**: Live scoreboard updates using HTMX (refreshes every 5 seconds)
-   **Score Management**: Judges can add new scores or update existing ones
-   **Responsive Design**: Clean, professional interface using Tailwind CSS

## Setup Instructions

### Prerequisites

-   PHP 8.2 or higher
-   Composer
-   Node.js and npm
-   SQLite (default) or MySQL/PostgreSQL

### Installation

1. **Clone the repository**

    ```bash
    git clone <repository-url>
    cd Judges
    ```

2. **Install PHP dependencies**

    ```bash
    composer install
    ```

3. **Install Node.js dependencies**

    ```bash
    npm install
    ```

4. **Environment setup**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. **Database setup**

    ```bash
    # Create SQLite database file (if using SQLite)
    touch database/database.sqlite

    # Run migrations
    php artisan migrate

    # Seed the database with sample data (optional)
    php artisan db:seed
    ```

6. **Build frontend assets**

    ```bash
    npm run build
    # or for development
    npm run dev
    ```

7. **Start the application**

    ```bash
    php -S localhost:8080 -t public
    ```

    The application will be available at `http://localhost:8080`

### Development Mode

For development with hot reloading:

```bash
composer run dev
```

This command starts the Laravel server, queue worker, logs, and Vite dev server concurrently.

## Database Schema

### Users Table

```sql
CREATE TABLE users (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

### Judges Table

```sql
CREATE TABLE judges (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    display_name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

### Scores Table

```sql
CREATE TABLE scores (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    judge_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    points INTEGER UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (judge_id) REFERENCES judges(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

### Supporting Tables

```sql
-- Sessions table for session management
CREATE TABLE sessions (
    id VARCHAR(255) NOT NULL PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload LONGTEXT NOT NULL,
    last_activity INTEGER NOT NULL,
    INDEX sessions_user_id_index (user_id),
    INDEX sessions_last_activity_index (last_activity)
);

-- Cache table for application caching
CREATE TABLE cache (
    key VARCHAR(255) NOT NULL PRIMARY KEY,
    value MEDIUMTEXT NOT NULL,
    expiration INTEGER NOT NULL
);

-- Jobs table for queue processing
CREATE TABLE jobs (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    queue VARCHAR(255) NOT NULL,
    payload LONGTEXT NOT NULL,
    attempts TINYINT UNSIGNED NOT NULL,
    reserved_at INTEGER UNSIGNED NULL,
    available_at INTEGER UNSIGNED NOT NULL,
    created_at INTEGER UNSIGNED NOT NULL,
    INDEX jobs_queue_index (queue)
);
```

## Application Routes

### Public Routes

-   `GET /` - Public scoreboard (real-time leaderboard)
-   `GET /scoreboard/data` - HTMX endpoint for scoreboard updates

### Admin Routes

-   `GET /admin` - Admin dashboard (manage judges)
-   `GET /admin/judges/create` - Create new judge form
-   `POST /admin/judges` - Store new judge
-   `DELETE /admin/judges/{judge}` - Delete judge

### Judge Routes

-   `GET /judges/{judge}` - Judge dashboard (list of participants to score)
-   `GET /judges/{judge}/score/{user}` - Score form for specific participant
-   `POST /judges/{judge}/score/{user}` - Submit/update score

## Assumptions Made

1. **No Authentication Required**: The system assumes judges access their portals via direct URLs without login authentication. This is suitable for controlled environments or events where judge access is managed externally.

2. **Score Range**: Scores are limited to 1-100 points as integers. This provides a standardized scoring system suitable for most competition formats.

3. **Single Score Per Judge-User Pair**: Each judge can only give one score per participant. Updating a score replaces the previous one rather than creating multiple entries.

4. **Real-time Updates**: The scoreboard updates every 5 seconds automatically, assuming this frequency is appropriate for the use case without causing excessive server load.

5. **SQLite Default**: The application defaults to SQLite for simplicity in development and small-scale deployments, but can be easily configured for MySQL/PostgreSQL in production.

6. **No User Registration**: Participants (users) are pre-seeded or manually added to the database rather than having a registration system.

## Design Choices

### Database Structure

-   **Separate Judge Model**: Judges are separate from users to allow for different authentication mechanisms and role-specific functionality in the future.
-   **Pivot Table for Scores**: The scores table acts as a pivot between judges and users, storing the relationship and score data with timestamps.
-   **Cascade Deletes**: Foreign key constraints with CASCADE delete ensure data integrity when judges or users are removed.

### Laravel/PHP Constructs Used

1. **Eloquent ORM**:

    - Used for clean, readable database interactions
    - Relationships defined in models (hasMany, belongsTo, belongsToMany)
    - Query scopes for complex data retrieval

2. **Route Model Binding**:

    - Automatic model injection in controller methods
    - Cleaner URLs and automatic 404 handling for non-existent records

3. **Form Request Validation**:

    - Centralized validation rules in controller methods
    - Automatic error handling and redirection

4. **Blade Templating**:

    - Component-based view structure with layouts
    - Conditional rendering and loops for dynamic content

5. **Database Migrations**:

    - Version-controlled database schema changes
    - Rollback capability and team collaboration support

6. **Database Seeders**:
    - Consistent test data generation
    - Factory pattern for creating realistic sample data

### Frontend Choices

-   **Tailwind CSS**: Utility-first CSS framework for rapid, consistent styling
-   **HTMX**: Lightweight library for real-time updates without complex JavaScript
-   **Responsive Design**: Mobile-first approach with clean, professional aesthetics

## Future Features (If More Time Available)

### Authentication & Security

-   [ ] Judge authentication system with secure login
-   [ ] Admin authentication and role-based access control
-   [ ] API rate limiting and CSRF protection
-   [ ] Audit logging for score changes

### Enhanced Functionality

-   [ ] Multiple scoring categories/criteria per participant
-   [ ] Weighted scoring system with different point values
-   [ ] Score comments and feedback from judges
-   [ ] Export scoreboard data to CSV/PDF
-   [ ] Email notifications for score updates

### User Experience

-   [ ] Real-time notifications using WebSockets
-   [ ] Mobile app for judges using Laravel API
-   [ ] Bulk score import/export functionality
-   [ ] Advanced filtering and search on scoreboard
-   [ ] Historical score tracking and analytics

### Administrative Features

-   [ ] User management interface for adding participants
-   [ ] Competition/event management (multiple events)
-   [ ] Score validation rules and approval workflows
-   [ ] Backup and restore functionality
-   [ ] Performance monitoring and caching optimization

### Technical Improvements

-   [ ] API endpoints for external integrations
-   [ ] Queue-based email notifications
-   [ ] Redis caching for improved performance
-   [ ] Docker containerization for easy deployment
-   [ ] Automated testing suite (Unit, Feature, Browser tests)

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
