<?php

return [
    'errors' => [
        'access_denied' => 'Vous n’êtes pas autorisé à accéder à la ressource demandée.',
        'not_found' => 'La ressource demandé est introuvable.',
        'expired' => 'Le fichier n’est plus disponible.',
        'upload_failed' => 'L’envoi de la ressource a échoué.',
        'upload_denied' => 'L’envoi de la ressource a été refusée.',
        'delete_denied' => 'La suppression de la ressource a été refusée.',
        'delete_failed' => 'La suppression de la ressource a échoué',
    ],
    'console' => [
        'done' => 'Terminé !',
        'cleanup_description' => 'Nettoie les pièces jointes non liées à un modèle.',
        'cleanup_confirm' => 'Confirmez-vous vouloir supprimer les pièces jointes non liées à un modèle ?',
        'cleanup_option_since' => 'Âge minimum (en minutes) des données à supprimer (se base sur la date de modification).',
        'cleanup_no_data' => 'Aucune pièce jointe à traiter.',
        'migrate_description' => 'Migre les pièces jointes d’un disque donné vers un autre en conservant le chemin.',
        'migrate_option_from' => 'Disque d’origine.',
        'migrate_option_to' => 'Disque de destination.',
        'migrate_error_missing' => 'Impossible de migrer vers le même disque.',
        'migrate_error_from' => 'Disque d’origine inconnu.',
        'migrate_error_to' => 'Disque de destination inconnu.',
        'migrate_invalid_from' => 'Disque d’origine illisible.',
        'migrate_invalid_to' => 'Disque de destination illisible.',
    ],
];
