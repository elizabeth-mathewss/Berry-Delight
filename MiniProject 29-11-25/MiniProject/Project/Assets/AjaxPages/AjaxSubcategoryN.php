<?php
include("../Connection/Connection.php");

if (isset($_GET['category_ids']) && !empty($_GET['category_ids'])) {
    // Sanitize each ID to ensure they are integers
    $category_ids = array_map('intval', $_GET['category_ids']);
    $id_list = implode(',', $category_ids);

    if (!empty($id_list)) {
        $subCatQry = "SELECT * FROM tbl_subcategory WHERE category_id IN (" . $id_list . ") ORDER BY subcategory_name";
        $subCatRes = $Con->query($subCatQry);

        if ($subCatRes->num_rows > 0) {
            while ($subCatData = $subCatRes->fetch_assoc()) {
                echo "<div class='filter-checkbox-item'>";
                // Add the onchange event to trigger a new search
                echo "<input type='checkbox' class='filter-checkbox' onchange='ajaxSearch()' name='subcategory[]' id='subcat_" . $subCatData['subcategory_id'] . "' value='" . $subCatData['subcategory_id'] . "'>";
                echo "<label for='subcat_" . $subCatData['subcategory_id'] . "'>" . htmlspecialchars($subCatData['subcategory_name']) . "</label>";
                echo "</div>";
            }
        }
    }
}
?>
