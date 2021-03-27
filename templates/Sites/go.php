<?php
use Cake\I18n\Time;
?>
<style>
    .w-12 {
        width: 3rem;
    }
    .h-12 {
        height: 3rem;
    }
    .outline-none {
        outline: 2px solid transparent;
        outline-offset: 2px;
    }
    .bg-gray-100 {
        --bg-opacity: 1;
        background-color: #edf2f7;
        background-color: rgba(237, 242, 247, var(--bg-opacity));
    }
    .rounded {
        -webkit-border-radius: 20px;
        -moz-border-radius: 20px;
        border-radius: 20px;
        outline: none;
        border: 1px solid #a0d18c;
        color: #2d9fd9;
    }
</style>


    <div class="px-3">
        <div class="row">
        <div class="col text-center">
        <img src="/site/img/logo.png">
        </div>
            <?php
            if(!@$nr){

            ?>
        <p class="lead">Insert the certificate number.</p>
        <p class="lead">

            <!-- Make sure the following div id (OTPInput) is the same in the Javascipt -->
          <?= $this->Form->create() ?>
                <!-- This is the div where the otp fields are generated by Javascript -->
                <div id="IDCERT" style="
  white-space:nowrap;
  overflow:auto;">
                </div>

                <!-- Change this name attribute to mach your form submission parameters. Make sure you update the id in the javascript code if any changes are made to the id attribute -->
                <input hidden id="otp" name="otp" value="">
            <div class="lead mt-5">
                <button class="btn btn-lg btn-secondary fw-bold border-white bg-white" id="otpSubmit" style="min-width: 40%"><?= __('Find') ?></button>
            </div>
                <?= $this->Form->end()  ?>

        </p>
            <?php
            }
else{

    ?>
            <div class="lead mt-5 p-4">
                <div class="row">
                    <div class="col-4"><?= '#' . $nr ?></div>
                    <div class="col-8"><b><?= $description['Title'] ?></b> by <?= $img['auteur'] ?></div>
                </div>
                <hr>
                <div class="row">

                    <div class="col-6">Date: <?= new Time($cert['metadata']['date_created']) ?></div>
                    <div class="col-6">Initial value: €<?= $cert['metadata']['product_gross_revenue'] ?></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12"><img src="<?= $imgURL ?>site/preview/<?= $img['ID'] ?>"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-1" style="text-align: left; padding:20px"></div>
                    <div class="col-10" style="text-align: left; padding:20px"><?= nl2br($sku['description']) ?></div>
                    <div class="col-1" style="text-align: left; padding:20px"></div>
                </div>

            </div>
<?php
}
            ?>


<?php
if(!@$nr){

?>

<script>

    /* This creates all the OTP input fields dynamically. Change the otp_length variable  to change the OTP Length */
    const $otp_length = 8;

    const element = document.getElementById('IDCERT');
    for (let i = 0; i < $otp_length; i++) {
        let inputField = document.createElement('input'); // Creates a new input element
        inputField.className = "w-12 h-12 bg-gray-100 border-gray-100 outline-none focus:bg-gray-200 m-2 text-center rounded focus:border-blue-100 focus:shadow-outline";
        // Do individual OTP input styling here;
        inputField.style.cssText = "color: black; text-shadow: 0 0 0 gray;font-weight:600;font-size:24px"; // Input field text styling. This css hides the text caret
        inputField.id = 'otp-field' + i; // Don't remove
        inputField.maxLength = 1; // Sets individual field length to 1 char
        element.appendChild(inputField); // Adds the input field to the parent div (OTPInput)
    }

    /*  This is for switching back and forth the input box for user experience */
    const inputs = document.querySelectorAll('#IDCERT > *[id]');
    for (let i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener('keydown', function (event) {
            if (event.key === "Backspace") {
                inputs[i].value = '';
                if (i !== 0) {
                    inputs[i - 1].focus();
                }
            } else if (event.key === "ArrowLeft" && i !== 0) {
                inputs[i - 1].focus();
            } else if (event.key === "ArrowRight" && i !== inputs.length - 1) {
                inputs[i + 1].focus();
            }
        });
        inputs[i].addEventListener('input', function () {
            inputs[i].value = inputs[i].value.toUpperCase(); // Converts to Upper case. Remove .toUpperCase() if conversion isnt required.
            if (i === inputs.length - 1 && inputs[i].value !== '') {
                return true;
            } else if (inputs[i].value !== '') {
                inputs[i + 1].focus();
            }
        });

    }
    /*  This is to get the value on pressing the submit button
    *   In this example, I used a hidden input box to store the otp after compiling data from each input fields
    *   This hidden input will have a name attribute and all other single character fields won't have a name attribute
    *   This is to ensure that only this hidden input field will be submitted when you submit the form */

    document.getElementById('otpSubmit').addEventListener("click", function () {
        const inputs = document.querySelectorAll('#IDCERT > *[id]');
        let compiledOtp = '';
        for (let i = 0; i < inputs.length; i++) {
            compiledOtp += inputs[i].value;
        }
        document.getElementById('otp').value = compiledOtp;
        return true;
    });
</script>
    <?php
}
?>