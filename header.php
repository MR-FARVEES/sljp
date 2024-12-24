<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" 2content="initial-scale=1.0">
        <title>SLJP</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
                crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
        <style>
                :root {
                        --my-secondary: #bbbcbd;
                        --my-primary: #b8f3ff;
                }

                .hover:hover {
                        background: var(--my-secondary);
                }

                .btn-hover:hover {
                        background: var(--my-primary);
                }

                .hover-secondary {
                        padding: 0 25px 0 25px;
                        border-radius: 25px;
                }

                .hover-secondary:hover {
                        background: var(--my-secondary);
                }

                .icon-cover {
                        padding: 20px;
                        border-radius: 30px;
                        background: var(--my-secondary);
                }

                .scale-1 {
                        transform: scale(1.2);
                        /* Adjust the scale to increase size */
                        /* margin-right: 10px;  */
                }

                .my-form-control:focus {
                        box-shadow: none !important;
                }

                textarea {
                        resize: none;
                }

                textarea {
                        width: 100%;
                        /* Make the textarea responsive */
                        min-height: 150px;
                        /* Set minimum height for the textarea */
                        box-sizing: border-box;
                        /* Prevent overflow */
                }

                .arrow-icon {
                        float: right;
                        margin-left: 5px;
                }

                .fa-angle-up {
                        transition: transform 0.3s ease-in-out;
                }

                .collapsed .fa-angle-up {
                        transform: rotate(-180deg);
                }

                .fa-angle-down {
                        transition: transform 0.3s ease-in-out;
                }

                .collapsed .fa-angle-down {
                        transform: rotate(-180deg);
                }

                .post-hover:hover {
                        text-decoration: underline !important;
                        color: blue !important;
                }

                .click-hover:hover {
                        cursor: pointer;
                        text-decoration: underline;
                }

                .job-hover:hover {
                        background-color: rgba(186, 186, 255, 0.2);
                }
        </style>
</head>

<body class="bg-light">