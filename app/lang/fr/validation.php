<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */

    "accepted"         => "Le champ :attribute doit être accepté.",
    "active_url"       => "Le champ :attribute n'est pas une URL valide.",
    "after"            => "Le champ :attribute doit être une date postérieure au :date.",
    "alpha"            => "Le champ :attribute doit seulement contenir des lettres.",
    "alpha_dash"       => "Le champ :attribute doit seulement contenir des lettres, des chiffres et des tirets.",
    "alpha_num"        => "Le champ :attribute doit seulement contenir des chiffres et des lettres.",
    "array"            => "Le champ :attribute doit être un tableau.",
    "before"           => "Le champ :attribute doit être une date antérieure au :date.",
    "between"          => array(
        "numeric" => "La valeur de :attribute doit être comprise entre :min et :max.",
        "file"    => "Le fichier :attribute doit avoir une taille entre :min et :max kilobytes.",
        "string"  => "Le texte :attribute doit avoir entre :min et :max caractères.",
        "array"   => "Le champ :attribute doit avoir entre :min - :max éléments."
    ),
    "confirmed"        => "Le champ de confirmation :attribute ne correspond pas.",
    "date"             => "Le champ :attribute n'est pas une date valide.",
    "date_format"      => "Le champ :attribute ne correspond pas au format :format.",
    "different"        => "Les champs :attribute et :other doivent être différents.",
    "digits"           => "Le champ :attribute doit avoir :digits chiffres.",
    "digits_between"   => "Le champ :attribute doit avoir entre :min and :max chiffres.",
    "email"            => "Le format du champ :attribute est invalide.",
    "exists"           => "Le champ :attribute sélectionné n'existe pas.",
    "image"            => "Le champ :attribute doit être une image.",
    "in"               => "Le champ :attribute est invalide.",
    "integer"          => "Le champ :attribute doit être un entier.",
    "ip"               => "Le champ :attribute doit être une adresse IP valide.",
    "max"              => array(
        "numeric" => "La valeur de :attribute ne peut être supérieure à :max.",
        "file"    => "Le fichier :attribute ne peut être plus gros que :max kilobytes.",
        "string"  => "Le texte de :attribute ne peut contenir plus de :max caractères.",
        "array"   => "Le champ :attribute ne peut avoir plus de :max éléments.",
    ),
    "mimes"            => "Le champ :attribute doit être un fichier de type : :values.",
    "min"              => array(
        "numeric" => "La valeur de :attribute doit être supérieur à :min.",
        "file"    => "Le fichier :attribute doit être plus que gros que :min kilobytes.",
        "string"  => "Le texte :attribute doit contenir au moins :min caractères.",
        "array"   => "Le champ :attribute doit avoir au moins :min éléments."
    ),
    "not_in"           => "Le champ :attribute sélectionné n'est pas valide.",
    "numeric"          => "Le champ :attribute doit contenir un nombre.",
    "regex"            => "Le format du champ :attribute est invalide.",
    "required"         => "Le champ :attribute est obligatoire.",
    "required_if"      => "Le champ :attribute est obligatoire quand la valeur de :other est :value.",
    "required_with"    => "Le champ :attribute est obligatoire quand :values est présent.",
    "required_with_all"=> "Le champ :attribute est obligatoire quand :values est présent.",
    "required_without" => "Le champ :attribute est obligatoire quand :values n'est pas présent.",
    "required_without_all" => "Le champ :attribute est obligatoire quand aucune de :values est présent.",
    "same"             => "Les champs :other doivent être identiques.",
    "size"             => array(
        "numeric" => "La taille de la valeur de :attribute doit être :size.",
        "file"    => "La taille du fichier de :attribute doit être de :size kilobytes.",
        "string"  => "Le texte de :attribute doit contenir :size caractères.",
        "array"   => "Le champ :attribute doit contenir :size éléments."
    ),
    "unique"           => "La valeur du champ :attribute est déjà utilisée.",
    "url"              => "Le format de l'URL de :attribute n'est pas valide.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => array(
         'valid'=> 'Votre compte est bien validé et activé.',
        'invalid'=> 'La clé ne correspond pas',
        'account_already_active'=> 'Compte déjà activé',
        'key_invalid'=> 'Format de la clé invalide',
        'tooMuchImage'=> 'Vous avez déjà attein le nombre limite d\'image (25)',
        'invalid_account'=> 'Cette combinaison est incorrecte',
        'inscription_localisation'=> 'La localisation de votre batîment à bien été enregistré !',
        'inscription_description_batiment'=> 'La description de votre bâtiment à bien été enregistré',
        'inscription_update_localisation'=> 'La localisation de votre batîment à bien été mis à jour !',
        'inscription_types_locations_multiple'=> 'Vos logements pour ce batîment ont bien été enregistrés !',
        'inscription_types_locations_single'=> 'Votre logement pour ce batîment à bien été crée !',
        'inscription_infos_general'=> 'Les informations concernant votre batîment ont bien été enregistrés',
        'inscription_adverts'=> 'Vos annonces ont été correctement enregistrés',
        'success_inscription_steps'=> 'Félicitation, votre bien à bien été enregistré avec toutes vos locations !',
        'message_success'=> 'Message bien envoyé !',
        'request_reservation_succes'=> 'Votre demande de réservation à bien été envoyé. Vous recevrez un retour du propriétaire par mail et via votre compte',
        'newsletter'=> 'Vous aviez bien été ajouté à la newsletter',
        'success_add_notice' => 'Merci beaucoup !<br> Votre avis à bien été enregistré, il doit être validé avant d\'être visible',
        'requestValidate' => 'Demande accepté !',
        'refuseValidate' => 'Demande refusé !',
        'userPhotoEdit' => 'Photo de profile bien modifié !',
        ),

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => array(
        "name" => "Nom",
        "username" => "Pseudo",
        "email" => "E-mail",
        "first_name" => "Prénom",
        "last_name" => "Nom",
        "password" => "Mot de passe",
        "city" => "Ville",
        "postal" => "Postal",
        "region" => "Région",
        "civility" => "Civilité",
        "country" => "Pays",
        "address" => "Adresse",
        "phone" => "Téléphone",
        "mobile" => "Portable",
        "age" => "Age",
        "company" => "Société",
        "sex" => "Sexe",
        "gender" => "Genre",
        "day" => "Jour",
        "month" => "Mois",
        "year" => "Année",
        "hour" => "Heure",
        "minute" => "Minute",
        "second" => "Seconde",
        "title" => "Titre",
        "content" => "Contenu",
        "description" => "Description",
        "excerpt" => "Extrait",
        "date" => "Date",
        "time" => "Heure",
        "available" => "Disponible",
        "size" => "Taille",
        "pro" => "Professionnel",
        "email_bc"=>'E-mail de secours',
        "password-ck"=>'Vérication du mot de passe',
        "password_ck"=>'Vérication du mot de passe',
        "email_co"=>'E-mail',
        "password_co"=>'Mot de passe',
        "login"=>'Identifiant',
        "advert"=>'Annonce',
        "garantee"=>'Caution',
        "situations"=>'Situations',
        "chargePrice"=>'Prix des charges',
        "start_date"=>'Date de début',
        "end_date"=>'Date de fin',
        "seat"=>'Places',
        "nb_locations"=>'Nombre de logements',
        "text"=>'Message',
        "situations.fr"=>'Situation en Français',
        "situations.nl"=>'Situation en Néerlandais',
        "situations.en"=>'Situation en Anglais',
        "advert.fr"=>'Annonce en Français',
        "advert.nl"=>'Annonce en Néerlandais',
        "advert.en"=>'Annonce en Anglais',
        "notice"=>'Avis',
        "nb_employer"=>'Nombre d\'employés',
        "locality"=>'Localité',
        "cgu"=>'Conditions générales d\'utilisation',
    ),

);
