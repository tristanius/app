<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Donde Estoy?</li>
        <?php
        foreach ($direccion_act as $sec) {
            ?>
            <li class="breadcrumb-item"><a href=""><?php echo $sec ?></a></li>
            <?php
        }
        ?>
    </ol>
</nav>