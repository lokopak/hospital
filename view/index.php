<!DOCTYPE html>
<html lang="es">
<?php require(__DIR__ . "/head.php"); ?>


<body>
    <?php require(__DIR__ . "/sidebar.php"); ?>

    <div class="page">
        <?php require(__DIR__ . "/header.php"); ?>
        <?php require(__DIR__ . "/breadcrumb.php"); ?>

        <header class="py-4">
            <div class="container-fluid py-2">
                <h1 class="h3 fw-normal mb-0">Sección</h1>
            </div>
        </header>
        <section class="pb-5">
            <div class="container-fluid">
                <!-- Contenido de la página -->
                <?php require(__DIR__ . "/ejemplos.php"); ?>
            </div>
        </section>
        <?php require(__DIR__ . "/footer.php"); ?>

    </div>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>