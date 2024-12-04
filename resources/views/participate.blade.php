<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participate Event</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('css/participate.css')}}" rel="stylesheet">
</head>
<body>

     <!-- Header Start -->
     <header id="header">
        <div class="container-fluid">

            <div id="logo" class="pull-left">
                <a href="{{route('index')}}"><img src="{{asset('assets/img/logo.png')}}" alt="Logo" /></a>
            </div>
        </div>
    </header>
   



    <div class="card">
        <div class="card-header">Participer à l'événement</div>
        <div class="card-body p-4">
            <!-- Display Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('participate.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="first_name" class="form-label">Prénom</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Entrez votre prénom" required>
                </div>
            
                <div class="mb-3">
                    <label for="last_name" class="form-label">Nom</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Entrez votre nom" required>
                </div>
            
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Entrez votre email" required>
                </div>
            
                <div class="mb-3">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Entrez votre numéro de téléphone" required>
                </div>
            
                <button type="submit" class="btn btn-custom w-100">Envoyer</button>
            </form>
            
        </div>
   
  
    </div>
    
    
    
    

    <!-- Footer Start -->
    <footer>
        <div class="footer-container">
            <p>© Copyright <strong>Crédit Agricole</strong>. Tous droits réservés</p>
            <p>Site réalisé par <a href="https://nextbridge.com" target="_blank">Next Bridge</a></p>
        </div>
    </footer>

    <!-- Footer End -->




    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>