<?php include("Header.php"); ?>
<main>
    <section id='section'>
        <article id="slogan">
            <h2> Créer une nouvelle fiche employé </h2>
        </article>
        <?php
        //si le formulaire est réaffiché à cause d'une erreur, on affiche l'erreur
        echo isset($_SESSION['POST']) ? $_SESSION['POST']['erreur'] : '';
        ?>
        <form action="/employee/create" method="post" id="formCreate" enctype="multipart/form-data">
            <div class='formulaire'>
                <label for="new_service">Vous pouvez créer un nouveau service</label>
                <div class="service-container">
                    <input type="text" id="new_service" placeholder="nouveau service">
                    <input type="button" id="ajout_service" value="créer"></div>

                <select name="serviceId" id="categorieRecherche" class="header-select">
                    <option value="">SELECTIONNEZ UN SERVICE</option>
                    <?php
                    //Récupération des services dans un SELECT
                    foreach ($services as $service) {
                        echo "<option value='" . $service->getServiceId() . "'>" . $service->getServiceName() . "</option>";
                    }
                    ?>
                </select>
                 <div class="normal">
                    <label for="employeeName">Prénom de l'employé(e)</label>
                    <input type="text" name="employeeName"
                           value="<?php echo isset($_SESSION['POST']) ? $_SESSION['POST']['employeeName'] : ''; ?>"
                           required id=" employeeName">
                </div>
                <div class="normal">
                    <label for="employeeSurname">Nom de l'employé(e)</label>
                    <input type="text" name="employeeSurname" value="<?php echo isset($_SESSION['POST']) ?
                        $_SESSION['POST']['employeeSurname'] : ''; ?>" required id=" employeeName">
                </div>
                <div>
                    <label for="employeeImage">Photo de l'employé(e)</label>

                    <input type="file" name="employeeImage" id="employeeImage"></div>

                <div class="normal">
                    <input type="submit" name="submitCreateEmployee" id="submit">
                </div>
            </div>
        </form>
    </section>
</main>
<?php

include("Footer.php"); ?>

