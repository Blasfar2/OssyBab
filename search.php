<?php
if (isset($_POST['query'])) {
    $query = $_POST['query'];

    // Sample data for suggestions, replace this with database queries in a real scenario
    $suggestions = [
        'samsung 45w',
        'samsung phones',
        'samsung galaxy a03',
        'samsung galaxy a13',
        'samsung galaxy a23',
        'samsung galaxy m52',
        'samsung galaxy a32',
        'samsung buds',
        'samsung tablette'
    ];

    $filteredSuggestions = array_filter($suggestions, function($suggestion) use ($query) {
        return stripos($suggestion, $query) !== false;
    });

    foreach ($filteredSuggestions as $suggestion) {
        echo "<a href='#' class='list-group-item list-group-item-action'>$suggestion</a>";
    }
}
?>
