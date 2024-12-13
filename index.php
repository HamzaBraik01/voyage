<?php
// dashboard.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Agence de Voyage</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex">
    <!-- Sidebar -->
    <div class="w-64 bg-blue-600 text-white flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-blue-500">
            Dashboard
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="client.php" class="block py-2 px-4 rounded hover:bg-blue-700">Ajouter un Client</a>
            <a href="add_reservation.php" class="block py-2 px-4 rounded hover:bg-blue-700">Ajouter une Réservation</a>
            <a href="activity.php" class="block py-2 px-4 rounded hover:bg-blue-700">Ajouter une Activité</a>
        </nav>
        <div class="p-4 border-t border-blue-500">
            <a href="#" class="block py-2 px-4 text-sm text-gray-200 hover:text-white">Déconnexion</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Bienvenue dans votre tableau de bord</h1>
        <p class="text-gray-600">Utilisez les options dans la barre latérale pour gérer vos clients, réservations et activités.</p>
        <!-- Example content -->
        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-700">Statistiques des Clients</h2>
                <p class="text-gray-500 mt-2">Nombre total de clients : 120</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-700">Réservations</h2>
                <p class="text-gray-500 mt-2">Réservations ce mois : 45</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-700">Activités Disponibles</h2>
                <p class="text-gray-500 mt-2">Total : 25</p>
            </div>
        </div>
    </div>
</body>
</html>
