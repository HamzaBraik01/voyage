<?php 
include 'connexion.php';
ob_start();

// Insert Client Function
function insertrActivite($titre, $description, $destination, $prix, $dateDebut, $dateFin, $placesDisponibles) { 
    include 'connexion.php';
    
    // Sécuriser les données pour éviter les injections SQL
    $titre = mysqli_real_escape_string($con, $titre);
    $description = mysqli_real_escape_string($con, $description);
    $destination = mysqli_real_escape_string($con, $destination);
    $prix = mysqli_real_escape_string($con, $prix);
    $dateDebut = mysqli_real_escape_string($con, $dateDebut);
    $dateFin = mysqli_real_escape_string($con, $dateFin);
    $placesDisponibles = mysqli_real_escape_string($con, $placesDisponibles);

    // Requête SQL pour insérer une nouvelle réservation dans la base de données
    $requete = "INSERT INTO activite (titre, description, destination, prix, date_debut, date_fin, places_disponibles) 
                VALUES ('$titre', '$description', '$destination', '$prix', '$dateDebut', '$dateFin', '$placesDisponibles')";
    
    // Exécution de la requête
    $query = mysqli_query($con, $requete);
    
    // Vérifier si l'insertion a réussi
    if ($query) {
        return true; // Réservation insérée avec succès
    } else {
        return false; // Échec de l'insertion
    }
}


// Fetch Clients Function
function fetchActivite() {
    include 'connexion.php';
    $sql = "SELECT * FROM activite"; // Requête pour récupérer toutes les réservations
    $result = mysqli_query($con, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td class='border border-gray-300 px-4 py-2'>{$row['titre']}</td>
                    <td class='border border-gray-300 px-4 py-2'>{$row['description']}</td>
                    <td class='border border-gray-300 px-4 py-2'>{$row['destination']}</td>
                    <td class='border border-gray-300 px-4 py-2'>{$row['prix']}</td>
                    <td class='border border-gray-300 px-4 py-2'>{$row['date_debut']}</td>
                    <td class='border border-gray-300 px-4 py-2'>{$row['date_fin']}</td>
                    <td class='border border-gray-300 px-4 py-2'>{$row['places_disponibles']}</td>
                    <td class='border border-gray-300 px-4 py-2'>
                        <!-- Container for buttons -->
                        <div class='flex space-x-3'>
                            <!-- Modifier Icon -->
                            <button class='bg-transparent text-yellow-500 p-2 rounded-full hover:bg-yellow-100'>
                                <svg viewBox='0 0 48 48' fill='none' xmlns='http://www.w3.org/2000/svg' class='w-5 h-5'>
                                    <g id='SVGRepo_bgCarrier' stroke-width='0'></g>
                                    <g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g>
                                    <g id='SVGRepo_iconCarrier'>
                                        <rect width='48' height='48' fill='white' fill-opacity='0.01'></rect>
                                        <path d='M42 26V40C42 41.1046 41.1046 42 40 42H8C6.89543 42 6 41.1046 6 40V8C6 6.89543 6.89543 6 8 6L22 6' stroke='#000000' stroke-width='4' stroke-linecap='round' stroke-linejoin='round'></path>
                                        <path d='M14 26.7199V34H21.3172L42 13.3081L34.6951 6L14 26.7199Z' fill='#2F88FF' stroke='#000000' stroke-width='4' stroke-linejoin='round'></path>
                                    </g>
                                </svg>
                            </button>

                            <!-- Supprimer Icon -->
                            <button class='bg-transparent text-red-500 p-2 rounded-full hover:bg-red-100'>
                                <svg fill='#ec0909' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' class='w-5 h-5'>
                                    <g id='SVGRepo_bgCarrier' stroke-width='0'></g>
                                    <g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g>
                                    <g id='SVGRepo_iconCarrier'>
                                        <path d='M5.755,20.283,4,8H20L18.245,20.283A2,2,0,0,1,16.265,22H7.735A2,2,0,0,1,5.755,20.283ZM21,4H16V3a1,1,0,0,0-1-1H9A1,1,0,0,0,8,3V4H3A1,1,0,0,0,3,6H21a1,1,0,0,0,0-2Z'></path>
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>Aucune donnée trouvée.</td></tr>";
    }
}




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = isset($_POST['titre']) ? htmlspecialchars(trim($_POST['titre'])) : null;
    $description = isset($_POST['description']) ? htmlspecialchars(trim($_POST['description'])) : null;
    $destination = isset($_POST['destination']) ? htmlspecialchars(trim($_POST['destination'])) : null;
    $prix = isset($_POST['prix']) ? htmlspecialchars(trim($_POST['prix'])) : null;
    $dateDebut = isset($_POST['dateDebut']) ? htmlspecialchars(trim($_POST['dateDebut'])) : null;
    $dateFin = isset($_POST['dateFin']) ? htmlspecialchars(trim($_POST['dateFin'])) : null;
    $placesDisponibles = isset($_POST['placesDisponibles']) ? htmlspecialchars(trim($_POST['placesDisponibles'])) : null;

    if ($titre && $description && $destination && $prix && $dateDebut && $dateFin && $placesDisponibles) {
        insertrActivite($titre, $description, $destination, $prix, $dateDebut, $dateFin, $placesDisponibles);
    }
}


mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Activite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        table {
            width: 100%;
            overflow-x: auto;
            display: block;
        }
        .sidebar-hidden {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }

        .sidebar-visible {
            transform: translateX(0);
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <div class="sidebar sidebar-visible w-32 bg-blue-600 text-white flex flex-col md:w-1/5">
        <button id="hamburgerBtn" class="block md:hidden p-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div class="p-6 text-2xl font-bold border-b border-blue-500">Dashboard</div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="client.php" class="block py-2 px-4 rounded hover:bg-blue-700">Ajouter un Client</a>
            <a href="reservation.php" class="block py-2 px-4 rounded hover:bg-blue-700">Ajouter une Réservation</a>
            <a href="activity.php" class="block py-2 px-4 rounded hover:bg-blue-700 sm:text-xs md:text-base">Ajouter une Activité</a>
        </nav>
        <div class="p-4 border-t border-blue-500">
            <a href="#" class="block py-2 px-4 text-sm text-gray-200 hover:text-white">Déconnexion</a>
        </div>
    </div>


    <!-- Main Content -->
        <!-- Main Content -->
        <div class="flex-1 p-10 sm:ml-0 md:ml-30 overflow-y-auto  ">
        <h1 class="text-3xl font-bold mb-6">Bienvenue au tableau de bord</h1>
        <button id="addClientBtn" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Ajouter une Activité</button>

        <!-- Table for Displaying Data -->
        <div class="mt-10">
            <table class="min-w-full max-w-4xl mx-auto table-auto border-collapse border border-gray-300 bg-white">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="border border-gray-300 px-4 py-2">Titre</th>
                        <th class="border border-gray-300 px-4 py-2">Description</th>
                        <th class="border border-gray-300 px-4 py-2">Destination</th>
                        <th class="border border-gray-300 px-4 py-2">Prix</th>
                        <th class="border border-gray-300 px-4 py-2">Places Disponibles</th>
                        <th class="border border-gray-300 px-4 py-2">Dates</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody id="clientTable">
                    
                    <?php fetchActivite(); ?>
                </tbody>
            </table>
        </div>

    


    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white rounded-xl shadow-lg w-4/5 sm:w-3/4 md:w-1/2 lg:w-1/3 max-w-sm p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center border-b pb-3">Ajouter un Activite</h2>
            <form id="voyageForm" method="post" action="" class="space-y-4">
                <div>
                    <label for="titre" class="block text-base font-medium text-gray-700 mb-1">Titre</label>
                    <input type="text" id="titre" name="titre" class="w-full border border-gray-300 rounded-lg py-1.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Entrez le titre du voyage" required>
                </div>
                <div>
                    <label for="description" class="block text-base font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="description" name="description" rows="3" class="w-full border border-gray-300 rounded-lg py-1.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Ajoutez une description du voyage" required></textarea>
                </div>
                <div>
                    <label for="destination" class="block text-base font-medium text-gray-700 mb-1">Destination</label>
                    <input type="text" id="destination" name="destination" class="w-full border border-gray-300 rounded-lg py-1.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Ex : Paris, France" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="prix" class="block text-base font-medium text-gray-700 mb-1">Prix</label>
                        <input type="number" id="prix" name="prix" class="w-full border border-gray-300 rounded-lg py-1.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Ex : 300" required>
                    </div>
                    <div>
                        <label for="placesDisponibles" class="block text-base font-medium text-gray-700 mb-1">Places Disponibles</label>
                        <input type="number" id="placesDisponibles" name="placesDisponibles" class="w-full border border-gray-300 rounded-lg py-1.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Ex : 50" required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="dateDebut" class="block text-base font-medium text-gray-700 mb-1">Date de Début</label>
                        <input type="date" id="dateDebut" name="dateDebut" class="w-full border border-gray-300 rounded-lg py-1.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    </div>
                    <div>
                        <label for="dateFin" class="block text-base font-medium text-gray-700 mb-1">Date de Fin</label>
                        <input type="date" id="dateFin" name="dateFin" class="w-full border border-gray-300 rounded-lg py-1.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    </div>
                </div>
                <div class="flex justify-end items-center space-x-3 mt-4">
                    <button type="button" id="closeModalBtn" class="bg-gray-400 text-white py-1.5 px-5 rounded-lg shadow hover:bg-gray-500 transition duration-150 ease-in-out">Annuler</button>
                    <button type="submit" class="bg-blue-600 text-white py-1.5 px-5 rounded-lg shadow hover:bg-blue-700 transition duration-150 ease-in-out">Ajouter</button>
                </div>
            </form>
        </div>
    </div>



    <script>
        const modal = document.getElementById('modal');
        const addClientBtn = document.getElementById('addClientBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');


        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const sidebar = document.querySelector('.sidebar');

        hamburgerBtn.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-hidden');
            sidebar.classList.toggle('sidebar-visible');
        });

        
        addClientBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
