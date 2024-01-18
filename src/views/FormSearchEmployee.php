<?php include("Header.php"); ?>
<main>
    <section id='section'>
        <article id="slogan">
            <h2> Rechercher une fiche employé(e)</h2>
        </article>
        <div>
            <table>
                <td>
                    <form action="/employee/search/service" method="post" id="formCreate" enctype="multipart/form-data">
                        <select name="serviceId" id="serviceRecherche" class="header-select"
                                onchange="this.form.submit()">
                            <option value="">FILTRER PAR SERVICE</option>
                            <?php
                            foreach ($services as $service) {
                                echo "<option value='" . $service->getServiceId() . "'>" . $service->getServiceName() . "</option>";
                            }
                            ?>
                        </select>
                    </form>
                </td>
                <td> &nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>
                <td>
                    <!--  BARRE DE RECHERCHE AJAX-->
                    <label for="employeeName">Chercher par nom ou prénom : </label><br>
                    <!-- Ajout d'un ID à l'input pour le gestionnaire d'évènement jQuer-->
                    <input type="search" name="employeeName" id="employeeName" autocomplete="off">
                    <br>
                    <!-- Conteneur avec une classe pour afficher la réponse de la requête AJAX -->
                    <div class="response-container"></div>
                </td>
            </table>
        </div>
    </section>

    <?php
    //***************  Si un contrôleur envoie un contenu, on l'affiche
    if (isset($contenu)) {
        echo $contenu;
    }
    ?>
    <?php include("Footer.php"); ?>

