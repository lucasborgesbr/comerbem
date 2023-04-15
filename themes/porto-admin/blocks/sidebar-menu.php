<ul class="nav nav-main">
    <?php

        $session = new \Source\Core\Session();
        if($session->has("authUserAdmin")):
    ?>
            <li>
                <a class="nav-link" href="<?= url("/app/adminBack"); ?>">
                    <i class="fas fa-undo" aria-hidden="true"></i>
                    <span>Voltar ao Admin</span>
                </a>
            </li>

        <?php endif; ?>
    <li>
        <a class="nav-link" href="<?= url("/app"); ?>">
            <i class="fas fa-home" aria-hidden="true"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li>
        <a class="nav-link" href="<?= url("/app/novo-perfil-mae"); ?>">
            <i class="fas fa-address-card" aria-hidden="true"></i>
            <span>Teste Perfil de Mãe</span>
        </a>
    </li>
    <li>
        <a class="nav-link" href="<?= url("/app/novo-enxoval"); ?>">
            <i class="fas fa-list" aria-hidden="true"></i>
            <span>Lista de Enxoval</span>
        </a>
    </li>
    <?php

    $iduser = user()->iduser;
    $enxoval = (new \Source\Models\Enxoval())->find("iduser = :iduser", "iduser={$iduser}")->fetch();

    if($enxoval):
    ?>
        <li>
            <a class="nav-link" target="_blank" href="<?= url("/enxoval/pdf/".base64_encode(user()->email)); ?>">
                <i class="fas fa-book" aria-hidden="true"></i>
                <span>Download PDF Enxoval</span>
            </a>
        </li>
    <?php endif; ?>
    <li>
        <a class="nav-link" href="<?= url("/app/download-ebook"); ?>">
            <i class="fas fa-book" aria-hidden="true"></i>
            <span>Download Ebook</span>
        </a>
    </li>
    <li>
        <a class="nav-link" target="_blank" href="https://api.whatsapp.com/send?1=pt_br&phone=+14072363536">
            <i class="fas fa-life-ring" aria-hidden="true"></i>
            <span>Fale Conosco!</span>
        </a>
    </li>

    <!--<li>
        <a class="nav-link support-form" href="#support-form">
            <i class="fas fa-life-ring" aria-hidden="true"></i>
            <span>Precisa de Ajuda?</span>
        </a>
    </li>-->
    <?php if(user()->admin): ?>

        <li style="border-bottom: 1px solid #DADADA;">
        </li>
        <span class="nav-link"><strong>Admin Control</strong></span>

        <li>
            <a class="nav-link" href="<?= url("/app/leads"); ?>">
                <i class="fas fa-stream" aria-hidden="true"></i>
                <span>Lista de Leads</span>
            </a>
        </li>

        <li>
            <a class="nav-link" href="<?= url("/app/assinaturas"); ?>">
                <i class="fas fa-hand-holding-usd" aria-hidden="true"></i>
                <span>Assinaturas</span>
            </a>
        </li>


    <?php endif; ?>


</ul>