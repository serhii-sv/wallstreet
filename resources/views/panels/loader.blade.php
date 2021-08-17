<style>
    .box {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: rgba(164, 180, 203, 0.95);

        display: flex;
        justify-content: center;
        align-items: center;
    }

    [id|=loader] {
        width: 100px;
        height: 100px;
        border-radius: 100%;
        position: relative;
        margin: 0 auto;
    }

    #loader-1:before,
    #loader-1:after {
        content: "";
        position: absolute;
        top: -10px;
        left: -10px;
        width: 100%;
        height: 100%;
        border-radius: 100%;
        border: 10px solid transparent;
    }
    #loader-1:before {
        border-top-color: #ff4081;
        animation: spin 1s infinite;
    }
    #loader-1:after {
        animation: spin 1s infinite alternate;
        border-bottom-color: #ccc;
    }
    @-moz-keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
    @-webkit-keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
    @-o-keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>
<div class="box">
    <div id="loader-1"></div>
</div>

<script>
    $(function () {
        $('.box').hide();
    })
</script>
