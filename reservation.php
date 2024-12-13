<?php 
include 'connexion.php';
ob_start();

$clientsQuery = "SELECT id_client, CONCAT(nom, ' ', prenom) AS nom_complet FROM client";
$clientsResult = mysqli_query($con, $clientsQuery);

$activitesQuery = "SELECT id_activite, titre FROM activite";
$activitesResult = mysqli_query($con, $activitesQuery);



function insertReservation($id_client, $id_activite, $date_reservation, $statut) {
    include 'connexion.php';

    $id_client = mysqli_real_escape_string($con, $id_client);
    $id_activite = mysqli_real_escape_string($con, $id_activite);
    $date_reservation = mysqli_real_escape_string($con, $date_reservation);
    $statut = mysqli_real_escape_string($con, $statut);

    $requete = "INSERT INTO reservation (id_client, id_activite, date_reservation, statut) 
                VALUES ('$id_client', '$id_activite', '$date_reservation', '$statut')";

    /*if (mysqli_query($con, $requete)) {
        echo "Réservation ajoutée avec succès.";
    } else {
        echo "Erreur lors de l'ajout de la réservation : " . mysqli_error($con);
    }*/

    mysqli_close($con);
}

function fetchReservation() {
    include 'connexion.php';
    $sql = "SELECT reservation.id_reservation, CONCAT(client.nom, ' ', client.prenom) AS nom_complet, activite.titre, reservation.date_reservation, reservation.statut
            FROM reservation
            JOIN client ON reservation.id_client = client.id_client
            JOIN activite ON reservation.id_activite = activite.id_activite"; 

    $result = mysqli_query($con, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td class='border border-gray-300 px-4 py-2'>{$row['nom_complet']}</td>
                    <td class='border border-gray-300 px-4 py-2'>{$row['titre']}</td>
                    <td class='border border-gray-300 px-4 py-2'>{$row['date_reservation']}</td>
                    <td class='border border-gray-300 px-4 py-2'>{$row['statut']}</td>
                    <td class='border border-gray-300 px-4 py-2'>
                        <div class='flex space-x-3'>
                            <button class='bg-transparent text-yellow-500 p-2 rounded-full hover:bg-yellow-100'>
                                <!-- Modifier Icon -->
                                <svg viewBox='0 0 48 48' fill='none' xmlns='http://www.w3.org/2000/svg' class='w-5 h-5'>
                                    <path d='M42 26V40C42 41.1046 41.1046 42 40 42H8C6.89543 42 6 41.1046 6 40V8C6 6.89543 6.89543 6 8 6L22 6' stroke='#000000' stroke-width='4' stroke-linecap='round' stroke-linejoin='round'></path>
                                    <path d='M14 26.7199V34H21.3172L42 13.3081L34.6951 6L14 26.7199Z' fill='#2F88FF' stroke='#000000' stroke-width='4' stroke-linejoin='round'></path>
                                </svg>
                            </button>
                            <button class='bg-transparent text-red-500 p-2 rounded-full hover:bg-red-100'>
                                <!-- Supprimer Icon -->
                                <svg viewBox='0 0 48 48' fill='none' xmlns='http://www.w3.org/2000/svg' class='w-5 h-5'>
                                    <path d='M14 6V7H34V6H14ZM18 6H30V9H18V6ZM16 7V42H32V7H16ZM12 9H36V42H12V9ZM10 42V9H38V42H10Z' fill='#ec0909'></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>";
        }
    
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_client = isset($_POST['id_client']) ? htmlspecialchars(trim($_POST['id_client'])) : null;
    $id_activite = isset($_POST['id_activite']) ? htmlspecialchars(trim($_POST['id_activite'])) : null;
    $date_reservation = isset($_POST['date_reservation']) ? htmlspecialchars(trim($_POST['date_reservation'])) : null;
    $statut = isset($_POST['statut']) ? htmlspecialchars(trim($_POST['statut'])) : null;

    if ($id_client && $id_activite && $date_reservation && $statut) {
        insertReservation($id_client, $id_activite, $date_reservation, $statut);
    } else {
        echo "Tous les champs sont requis.";
    }
}

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
        <div class="flex-1 p-10 sm:ml-0 md:ml-30 overflow-y-auto  ">
        <h1 class="text-3xl font-bold mb-6">Gestion Les Reservation</h1>
        <button id="addClientBtn" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Ajouter un Reservation</button>

        <div class="mt-10">
            <table class="min-w-full max-w-4xl mx-auto table-auto border-collapse border border-gray-300 bg-white shadow-lg rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-left text-sm font-semibold text-gray-700">
                        <th class="border border-gray-300 px-6 py-3">Nom Client</th>
                        <th class="border border-gray-300 px-6 py-3">Activité</th>
                        <th class="border border-gray-300 px-6 py-3">Date de Réservation</th>
                        <th class="border border-gray-300 px-6 py-3">Statut</th>
                        <th class="border border-gray-300 px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody id="clientTable" class="text-gray-600 text-sm divide-y divide-gray-300">
                    <?php fetchReservation(); ?>
                </tbody>
            </table>
        </div>

    </div>


    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg w-11/12 sm:w-1/2 md:w-1/3 max-w-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Ajouter une Réservation</h2>
            <form id="reservationForm" method="post" action="">
                <div class="mb-4">
                    <label for="id_client" class="block text-gray-700">Client</label>
                    <select id="id_client" name="id_client" class="w-full border border-gray-300 rounded py-2 px-4 focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="">-- Sélectionner un client --</option>
                        <?php while ($client = mysqli_fetch_assoc($clientsResult)) { ?>
                            <option value="<?= $client['id_client'] ?>"><?= $client['nom_complet'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="id_activite" class="block text-gray-700">Activité</label>
                    <select id="id_activite" name="id_activite" class="w-full border border-gray-300 rounded py-2 px-4 focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="">-- Sélectionner une activité --</option>
                        <?php while ($activite = mysqli_fetch_assoc($activitesResult)) { ?>
                            <option value="<?= $activite['id_activite'] ?>"><?= $activite['titre'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="date_reservation" class="block text-gray-700">Date de Réservation</label>
                    <input type="date" id="date_reservation" name="date_reservation" class="w-full border border-gray-300 rounded py-2 px-4 focus:outline-none focus:ring focus:ring-blue-300">
                </div>

                <div class="mb-4">
                    <label for="statut" class="block text-gray-700">Statut</label>
                    <select id="statut" name="statut" class="w-full border border-gray-300 rounded py-2 px-4 focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="EN attente">En attente</option>
                        <option value="Confirmée">Confirmée</option>
                        <option value="Annulée">Annulée</option>
                    </select>
                </div>

                
                <div class="flex justify-end space-x-4">
                    <button type="button" id="closeModalBtn" class="bg-gray-400 text-white py-2 px-4 rounded hover:bg-gray-500">Annuler</button>
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Ajouter</button>
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
