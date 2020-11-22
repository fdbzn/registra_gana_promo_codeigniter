
<form id="f_reports" class="form-inline" action="" method="GET">
  <div class="form-group ">
    <label for="start_date" class="sr-only">Fecha inicial</label>
    <input type="input" autocomplete="off" data-date-format="yyyy-mm-dd" class="form-control date-input" name="start_date" id="start_date" value="">
  </div>
  <div class="form-group mx-sm-3 ">
    <label for="end_date" class="sr-only">Fecha final</label>
    <input type="input" autocomplete="off" data-date-format="yyyy-mm-dd" class="form-control date-input" name="end_date" id="end_date">
  </div>
  <input type="submit" class="btn btn-primary mb-2" value="Generar">
</form>

<div class="row">
  <div class="mt-5 col-md-3 report_cards" >
      <div class="card border-success mx-sm-1 p-3">
          <div class="card border-success shadow text-success p-3 my-card" ><span class="fa fa-file-excel-o" aria-hidden="true"></span></div>
          <div class="text-success text-center mt-3"><h4>Usuarios</h4></div>
          <div class="text-success text-center mt-2">
              <h3>
                  <a href="#" target="_blank" class="text-success download-link" data-url='<?=base_url()?>manager/csv_report_users?'>
                      Descargar
                  </a>
              </h3>
          </div>
      </div>
  </div>

  <div class="mt-5 col-md-3 report_cards" >
      <div class="card border-success mx-sm-1 p-3">
          <div class="card border-success shadow text-success p-3 my-card" ><span class="fa fa-file-excel-o" aria-hidden="true"></span></div>
          <div class="text-success text-center mt-3"><h4>Códigos</h4></div>
          <div class="text-success text-center mt-2">
              <h3>
                  <a href="#" target="_blank" class="text-success download-link" data-url='<?=base_url()?>manager/csv_report_codes?'>
                      Descargar
                  </a>
              </h3>
          </div>
      </div>
  </div>
</div>