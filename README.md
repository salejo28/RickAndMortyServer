# RickAnd Morty (API)

## Steps

### Download the project

```
git clone https://github.com/santi280403/RickAndMortyServer.git
```

### Navigate to the project

```
cd RickAndMortyServer
```

### Install dependencies

```
composer install
```

### Copy the .env.example

```
cp .env.example .env
```

### Generate keys

```
php artisan key:generate
```

### Migrate Database

```
php artisan migrate
```

### Run the project

```
php artisan serv
```

## Routes

### Characters

-   **(GET)** get characters **api/characters**
-   **(GET)** paginate characters **api/characters?page=1**
-   **(GET)** search characters **api/characters?search=rick**
-   **(GET)** paginate an search characters **api/characters?page=1&search=rick**
-   **(POST)** create characters **api/characters**
-   **(PUT)** update characters **api/characters/{idCharacter}**
-   **(DELETE)** update characters **api/characters/{idCharacter}**

### Locations

-   **(GET)** get locations **api/locations**
-   **(GET)** paginate locations **api/locations?page=1**
-   **(GET)** search locations **api/locations?search=earth**
-   **(GET)** paginate an search locations **api/locations?page=1&search=earth**
-   **(POST)** create locations **api/locations**
-   **(PUT)** update locations **api/locations/{idLocation}**
-   **(DELETE)** update locations **api/locations/{idLocation}**

### Episodes

-   **(GET)** get episodes **api/episodes**
-   **(GET)** paginate episodes **api/episodes?page=1**
-   **(GET)** search episodes **api/episodes?search=pilot**
-   **(GET)** paginate an search episodes **api/episodes?page=1&search=pilot**
-   **(POST)** create episodes **api/episodes**
-   **(PUT)** update episodes **api/episodes/{iEpisode}**
-   **(DELETE)** update episodes **api/episodes/{idEpisode}**

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
