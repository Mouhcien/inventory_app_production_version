<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bon de Consommation</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        header img {
            width: 100%; /* Set a fixed width for the logo */
            height: 130px; /* Maintain the aspect ratio */
        }

        header h4,
        header h5 {
            margin: 0;
            color: #333;
            text-align: left;
        }

        .column {
            display: block; /* Stacked layout (DomPDF doesn't support flex or grid) */
            margin-bottom: 120px;
        }

        /* Left and right column styling */
        .right-column, .left-column {
            width: 48%; /* Use percentage width for DomPDF compatibility */
            float: left; /* Allow columns to float side by side */
            padding: 10px;
        }

        /* Ensure both columns align next to each other */
        .right-column {
            margin-right: 4%; /* Space between columns */
        }

        /* Headings styling */
        .right-column h4, .left-column h4 {
            margin: 0;
            font-size: 16px;
            color: #333;
        }

        .right-column h5, .left-column h5 {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }

        /* Clear floats after columns */
        .clear {
            clear: both;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 8px;
            border: 2px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #dcdcdc;
            color: #333;
        }

        table td p {
            margin: 15px;
            font-size: 14px;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            margin: 2px;
            font-size: 12px;
            border-radius: 5px;
        }

        .bg-info {
            background-color: #17a2b8;
            color: white;
        }

        .bg-light {
            background-color: #f8f9fa;
        }

        .bg-primary {
            background-color: #007bff;
            color: white;
        }

        footer {
            margin-top: 40px;
        }

        /* Container for footer elements */
        .footer-container {
            width: 100%;
            display: block;
            margin-top: 20px;
        }

        /* Left column (Cachet et Signature) */
        footer .left-column {
            float: left;
            width: 48%; /* Takes 48% of the width */
            padding: 10px;
        }

        /* Right column (Date) */
        footer .right-column {
            float: right;
            width: 48%; /* Takes 48% of the width */
            text-align: right;
            padding: 10px;
        }

        /* Clear floats after footer */
        footer .clear {
            clear: both;
        }

    </style>
</head>
<body>
<div class="container">
    <header>
        <div>
            <img src="{{ public_path('images/dri.jpg') }}" alt="Logo">
        </div>
        <div class="column">
            <div class="right-column">
                <h4>Direction Régionale des Impôts</h4>
                <h5>Marrakech</h5>
            </div>
            <div class="left-column">
                <h4>BUREAU DE L'EXPLOITATION ET DE LA SECURITE INFORMATIQUE</h4>
                <h5>SECTION DE LA MAINTENANCE ET DU SUPPORT TECHNIQUE</h5>
            </div>
        </div>
    </header>

    <section>
        <table>
            <thead>
            <tr>
                <th>Quantité</th>
                <th>Désignation</th>
                <th>Bénéficiaire</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$consummation->quantity_required}}</td>
                <td>
                    <p>{{$consummation->stock_consumable->consumable->type_consumable->title}}</p>
                    <p>{{$consummation->stock_consumable->consumable->ref}}</p>
                    <p>{{$consummation->stock_consumable->consumable->description}}</p>
                </td>
                <td>
                    <h4>{{$consummation->employee->firstname}} {{$consummation->employee->lastname}}</h4>
                    @if($consummation->employee->secter_entity)
                        <span class="badge bg-info">Secteur : </span><span class="badge bg-light">{{$consummation->employee->secter_entity->title}}</span><br>
                    @endif
                    @if($consummation->employee->section_entity)
                        <span class="badge bg-info">Section : </span><span class="badge bg-light">{{ $consummation->employee->section_entity->title }}</span><br>
                    @endif
                    @if($consummation->employee->entity)
                        <span class="badge bg-info">Entité : </span><span class="badge bg-light">{{ $consummation->employee->entity->title }}</span><br>
                    @endif
                    <span class="badge bg-info">Service : </span><span class="badge bg-primary">{{ $consummation->employee->service_entity->title }}</span>
                    <hr>
                    <span class="badge bg-info">Local : </span><span class="badge bg-light">{{ $consummation->employee->local->title }}</span><br>
                    <span class="badge bg-info">Ville : </span><span class="badge bg-light">{{ $consummation->employee->local->city->title }}</span>
                </td>
            </tr>
            </tbody>
        </table>
    </section>

    <footer>
        <div class="footer-container">
            <div class="left-column">
                Cachet et Signature
            </div>
            <div class="right-column">
                Marrakech le, {{ \Carbon\Carbon::parse($consummation->consummation_date)->format('d/m/Y') }}
            </div>
        </div>
    </footer>
</div>
</body>
</html>
