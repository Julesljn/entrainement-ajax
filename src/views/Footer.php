<?php
//si le formulaire est réaffiché avec des infos en session,
// on supprime la variable $_SESSION['POST']
if (isset($_SESSION['POST'])) {
    unset ($_SESSION['POST']);
}
?>

</main>
<script type="text/javascript" src="/js/searchEmployeeByName.js"></script>
<script type="text/javascript" src="/js/ajoutService.js"></script>
<footer>
    <h2>&copy; 2024 - Trombistock</h2>
</footer>
</body>
</html


