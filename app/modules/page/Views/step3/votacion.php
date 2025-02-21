<?php echo $this->tarjeton ?>
<?php if ($this->posicionvotacion != 0) { ?>
    <script language='javascript' type='text/javascript'>
        function DisableBackButton() {
            window.history.forward()
        }
        DisableBackButton();
        window.onload = DisableBackButton;
        window.onpageshow = function(evt) {
            if (evt.persisted) DisableBackButton()
        }
        window.onunload = function() {
            void(0)
        }
    </script>
<?php } ?>

<script>
    /* function activarCheckbox(id) {
        const checkbox = document.getElementById('candidate_' + id);
        checkbox.checked = !checkbox.checked;
    } */
</script>
<style>
    body {
        min-height: 100dvh;
        height: 100%;
    }

    footer {
        position: absolute;
        width: 100%;
        z-index: 2;
        bottom: 0;
    }

  

    .contenedor-general {
        min-height: calc(100% - 150px);
        height: 100%;
        padding-bottom: 100px;

    }
</style>