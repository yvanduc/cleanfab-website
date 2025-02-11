# Configuration ACF - Champs de Réservation

## Groupe de Champs : Réservation

### 1. Information Client
- **Nom du groupe :** Informations Client
- **Position :** Normal
- **Règles d'affichage :** 
  * Post Type is equal to Post

#### Champs
1. **Nom du client**
   - Type : Texte
   - Requis : Oui
   - Placeholder : Nom complet du client

2. **Email**
   - Type : Email
   - Requis : Oui
   - Placeholder : Adresse email du client

3. **Téléphone**
   - Type : Texte
   - Requis : Oui
   - Placeholder : Numéro de téléphone

### 2. Information Véhicule
- **Nom du groupe :** Informations Véhicule

#### Champs
1. **Marque**
   - Type : Texte
   - Requis : Oui

2. **Modèle**
   - Type : Texte
   - Requis : Oui

### 3. Information Réservation
- **Nom du groupe :** Détails Réservation

#### Champs
1. **Date**
   - Type : Date Picker
   - Requis : Oui
   - Format : d/m/Y
   - Restrictions : Date future uniquement

2. **Heure**
   - Type : Select
   - Choix : 7:00 à 18:00 (par tranches de 15min)
   - Requis : Oui

3. **Service**
   - Type : Select
   - Choix :
     * Nettoyage Intérieur
     * Nettoyage Extérieur
     * Nettoyage Complet
   - Requis : Oui

4. **Statut**
   - Type : Select
   - Choix :
     * En attente
     * Confirmé
     * Annulé
   - Défaut : En attente
   - Requis : Oui

5. **Notes**
   - Type : Textarea
   - Requis : Non
   - Placeholder : Notes internes sur la réservation

## Instructions d'installation

1. Dans WordPress Admin, aller à "Custom Fields" > "Ajouter"
2. Créer trois groupes de champs distincts
3. Configurer les règles d'affichage pour chaque groupe
4. Ajouter les champs selon les spécifications ci-dessus
5. Sauvegarder les groupes

## Utilisation dans le thème

```php
// Exemple d'utilisation dans le template
$date = get_field('date');
$heure = get_field('heure');
$service = get_field('service');
$statut = get_field('statut');

// Affichage des informations
echo "Réservation pour le " . $date . " à " . $heure;
echo "Service : " . $service;
echo "Statut : " . $statut;
```
