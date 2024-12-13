<?php 
include 'connexion.php';
ob_start();

// Insert Client Function
function insertClient($nom, $prenom, $email, $telephone, $adresse, $dateNaissance) {
    include 'connexion.php';
    $nom = mysqli_real_escape_string($con, $nom);
    $prenom = mysqli_real_escape_string($con, $prenom);
    $email = mysqli_real_escape_string($con, $email);
    $telephone = mysqli_real_escape_string($con, $telephone);
    $adresse = mysqli_real_escape_string($con, $adresse);
    $dateNaissance = mysqli_real_escape_string($con, $dateNaissance);

    $requete = "INSERT INTO client (nom, prenom, email, telephone, adresse, date_naissance) 
                VALUES ('$nom', '$prenom', '$email', '$telephone', '$adresse', '$dateNaissance')";
    $query = mysqli_query($con, $requete);
}

// Fetch Clients Function
function fetchClients() {
    include 'connexion.php';
    $sql = "SELECT * FROM client";
    $result = mysqli_query($con, $sql);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            
            echo "<tr>
                    <td class='border border-gray-300 px-4 py-2'>{$row['nom']}</td>
                    <td class='border border-gray-300 px-4 py-2'>{$row['prenom']}</td>
                    <td class='border border-gray-300 px-4 py-2'>{$row['email']}</td>
                    <td class='border border-gray-300 px-4 py-2'>{$row['telephone']}</td>
                    <td class='border border-gray-300 px-4 py-2'>{$row['adresse']}</td>
                    <td class='border border-gray-300 px-4 py-2'>{$row['date_naissance']}</td>
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
        echo "<tr><td colspan='7'>Aucune donnée trouvée.</td></tr>";
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = isset($_POST['nom']) ? htmlspecialchars(trim($_POST['nom'])) : null;
    $prenom = isset($_POST['prenom']) ? htmlspecialchars(trim($_POST['prenom'])) : null;
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : null;
    $telephone = isset($_POST['telephone']) ? htmlspecialchars(trim($_POST['telephone'])) : null;
    $adresse = isset($_POST['adresse']) ? htmlspecialchars(trim($_POST['adresse'])) : null;
    $dateNaissance = isset($_POST['dateNaissance']) ? htmlspecialchars(trim($_POST['dateNaissance'])) : null;

    if ($nom && $prenom && $email && $telephone && $adresse && $dateNaissance) {
        insertClient($nom, $prenom, $email, $telephone, $adresse, $dateNaissance);
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Client</title>
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
        <h1 class="text-3xl font-bold mb-6">gestion les reservation</h1>
        <button id="addClientBtn" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Ajouter un Reservation</button>

        <!-- Table for Displaying Data -->
        <div class="mt-10 ">
            <table class="min-w-full max-w-4xl mx-auto table-auto border-collapse border border-gray-300 bg-white">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="border border-gray-300 px-4 py-2">Nom</th>
                        <th class="border border-gray-300 px-4 py-2">Prénom</th>
                        <th class="border border-gray-300 px-4 py-2">Email</th>
                        <th class="border border-gray-300 px-4 py-2">Téléphone</th>
                        <th class="border border-gray-300 px-4 py-2">Adresse</th>
                        <th class="border border-gray-300 px-4 py-2">Date de Naissance</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody id="clientTable">
                    <?php fetchClients(); ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg w-11/12 sm:w-1/2 md:w-1/3 max-w-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Ajouter un Client</h2>
            <form id="clientForm" method="post" action="">
                <div class="mb-4">
                    <label for="nom" class="block text-gray-700">Nom</label>
                    <input type="text" id="nom" name="nom" class="w-full border border-gray-300 rounded py-2 px-4 focus:outline-none focus:ring focus:ring-blue-300">
                </div>
                <div class="mb-4">
                    <label for="prenom" class="block text-gray-700">Prénom</label>
                    <input type="text" id="prenom" name="prenom" class="w-full border border-gray-300 rounded py-2 px-4 focus:outline-none focus:ring focus:ring-blue-300">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded py-2 px-4 focus:outline-none focus:ring focus:ring-blue-300">
                </div>
                <div class="mb-4">
                    <label for="telephone" class="block text-gray-700">Téléphone</label>
                    <input type="tel" id="telephone" name="telephone" class="w-full border border-gray-300 rounded py-2 px-4 focus:outline-none focus:ring focus:ring-blue-300">
                </div>
                <div class="mb-4">
                    <label for="adresse" class="block text-gray-700">Adresse</label>
                    <input type="text" id="adresse" name="adresse" class="w-full border border-gray-300 rounded py-2 px-4 focus:outline-none focus:ring focus:ring-blue-300">
                </div>
                <div class="mb-4">
                    <label for="dateNaissance" class="block text-gray-700">Date de Naissance</label>
                    <input type="date" id="dateNaissance" name="dateNaissance" class="w-full border border-gray-300 rounded py-2 px-4 focus:outline-none focus:ring focus:ring-blue-300">
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" id="closeModalBtn" class="bg-gray-400 text-white py-2 px-4 rounded hover:bg-gray-500">Annuler</button>
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 sm:px-3 sm:py-1">Ajouter</button>
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
