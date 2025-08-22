<nav class="navbar navbar-expand-lg bg-primary fixed-top shadow-lg" data-bs-theme="light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('dri')}}">CRI-MARRAKECH</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('inventories.index')}}">
                        <i class="bi bi-stack"></i>
                        Inventaire
                        <span class="visually-hidden">(current)</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-pc"></i>
                        <i class="bi bi-laptop"></i>
                        <i class="bi bi-printer-fill"></i>
                        Matériels-DRI
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('models.index')}}">
                            <i class="bi bi-box-fill me-1"></i>
                            Modèles du matériel
                        </a>
                        <a class="dropdown-item" href="{{route('marchs.index')}}">
                            <i class="bi bi-bank2 me-1"></i>
                            Marchés du matériel
                        </a>
                        <a class="dropdown-item" href="{{route('brands.index')}}">
                            <i class="bi bi-collection-fill me-1"></i>
                            Marques du matériel
                        </a>
                        <a class="dropdown-item" href="{{route('types.index')}}">
                            <i class="bi bi-border-style me-1"></i>
                            Types du matériel
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('materials.index')}}">
                            <i class="bi bi-clipboard-check me-1"></i>
                            Gestion des matériels
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-person-vcard"></i>
                        Employées-DRI
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('services.index')}}"><i class="bi bi-diagram-3-fill me-2"></i>Service du DRI</a>
                        <a class="dropdown-item" href="{{route('entities.index')}}"><i class="bi bi-columns-gap me-2"></i>Entité Adminstratives DRI</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('employees.index')}}"><i class="bi bi-people-fill me-2"></i>Gestion des employés</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-joystick"></i>
                        Local-DRI
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('cities.index')}}"><i class="bi bi-globe me-2"></i>Gestion des Villes</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('locals.index')}}"><i class="bi bi-buildings-fill me-2"></i>Gestion des locaux-DRI</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-journal-check me-2"></i>
                        Fournitures
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('deliveries.index')}}"><i class="bi bi-truck me-2"></i>Livraisons de furnitures</a>
                        <a class="dropdown-item" href="{{route('consumables.index')}}"><i class="bi bi-hourglass me-2"></i>Gestion de consommables</a>
                        <a class="dropdown-item" href="{{route('stocks.index')}}"><i class="bi bi-house-door me-2"></i>Stock de furnitures</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('consummations.index')}}"><i class="bi bi-hourglass-split me-2"></i>Gestion de consommations</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-bar-chart-fill me-2"></i>
                        Statistiques
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('statistics.material')}}">
                            <i class="bi bi-pie-chart"></i>
                            Matériels Informatique
                            <i class="bi bi-pc"></i>
                            <i class="bi bi-printer"></i>
                            <i class="bi bi-laptop me-2"></i>
                        </a>
                        <a class="dropdown-item" href="{{route('statistics.employee')}}"><i class="bi bi-people me-2"></i>Employés du DRI</a>
                        <a class="dropdown-item" href="{{route('statistics.furniture')}}"><i class="bi bi-hourglass-split me-2"></i>Fournitures</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('statistics.index')}}"><i class="bi bi-globe me-2"></i>Statistiques Global</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
