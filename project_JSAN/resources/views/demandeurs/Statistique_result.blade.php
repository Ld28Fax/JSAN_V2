
@if($nombreDemandeursPeriode || $nombreDemandeursActifPeriode || $nombreDemandeursInactifPeriode || $nombreDemandeursRefuséPeriode)
    <table>
        <thead>
            <tr>
                <td>Total de demandeurs</td>
                <td>Demandeurs Acceptés</td>
                <td>Demandeurs Refusés</td>
                <td>Demandeurs en cours de traitement</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $nombreDemandeursPeriode }}</td> 
                <td>{{ $nombreDemandeursActifPeriode }}</td>
                <td>{{ $nombreDemandeursRefuséPeriode }}</td>
                <td>{{ $nombreDemandeursInactifPeriode }}</td>
            </tr>
        </tbody>
    </table>
@else
    <p class="alert alert-danger">Aucun demandeur trouvé pour la période sélectionnée.</p>
@endif
