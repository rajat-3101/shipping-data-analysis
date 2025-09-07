@extends('adminlte::page')
@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Upload Report</h2>
    <div class="card shadow" style="max-width: 900px; margin: 0 auto;">
        <div class="card-body">
            <form action="{{ route('report-upload.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="report_date" class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="report_date" name="report_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="vessel_id" class="form-label">Vessel <span class="text-danger">*</span></label>
                            <select name="vessel_id" id="vessel_id" class="form-control" required>
                                <option value="">Select Vessel</option>
                                @foreach($vessels as $vessel)
                                    <option value="{{ $vessel->id }}" {{ isset($selectedVessel) && $selectedVessel == $vessel->id ? 'selected' : '' }}>{{ $vessel->vessel_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="voyage_id" class="form-label">Voyage <span class="text-danger">*</span></label>
                            <select name="voyage_id" id="voyage_id" class="form-control" required>
                                <option value="">Select Voyage</option>
                                @foreach($voyages as $voyage)
                                    <option value="{{ $voyage->id }}">{{ $voyage->voyage_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="report_type_id" class="form-label">Report Type <span class="text-danger">*</span></label>
                            <select name="report_type_id" id="report_type_id" class="form-control" required>
                                <option value="">Select Type</option>
                                @foreach($reportTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->report_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="report_file" class="form-label">Upload CSV/Excel File <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="report_file" name="report_file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                            <small class="text-muted">Supported formats: .csv, .xlsx, .xls</small>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="submit" class="btn btn-success  px-4">Upload Report</button>
                    <a href="{{ route('noon-report.index') }}" class="btn btn-secondary ml-3 px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="page-loader" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(255,255,255,0.7); z-index:9999; justify-content:center; align-items:center;">
    <div class="spinner-border text-primary" style="width:3rem; height:3rem;"></div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const vesselSelect = document.getElementById('vessel_id');
        const voyageSelect = document.getElementById('voyage_id');
        const submitBtn = document.querySelector('button[type="submit"]');
        const pageLoader = document.getElementById('page-loader');

        vesselSelect.addEventListener('change', function() {
            const vesselId = this.value;
            pageLoader.style.display = 'flex';
            submitBtn.disabled = true;
            voyageSelect.innerHTML = '<option value="">Loading...</option>';
            fetch(`/report-upload/voyages?vessel_id=${vesselId}`)
                .then(response => response.json())
                .then(data => {
                    let options = '<option value="">Select Voyage</option>';
                    data.forEach(function(voyage) {
                        options += `<option value="${voyage.id}">${voyage.voyage_name}</option>`;
                    });
                    voyageSelect.innerHTML = options;
                })
                .finally(() => {
                    pageLoader.style.display = 'none';
                    submitBtn.disabled = false;
                });
        });
    });
</script>
@endsection