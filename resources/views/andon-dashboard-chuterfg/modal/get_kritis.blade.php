{{-- <div class="modal fade bd-example-modal-lg" id="detailModalkritis" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="z-index: 1050;">
    <div class="modal-dialog modal-lg" style="max-width: 1000px; width: 100%;">
        <div class="modal-content">
            <div class="modal-header border-bottom text-dark">
                <h4 class="modal-title" id="modalLabel">Monitoring Min Max -- Kritis --</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tbl-data-kritis" class="table table-striped table-bordered table-hover" width="100%">
                    <thead style="text-transform: uppercase; font-size: 11px;">
                        <tr>
                            <th>Itemcode</th>
                            <th>Part no</th>
                            <th>Part name</th>
                            <th>Stock</th>
                            <th>Min</th>
                            <th>Max</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div> --}}
<div class="modal fade" id="detailModalkritis" tabindex="-1" aria-labelledby="detailModalkritisLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailModalkritisLabel">Kritis</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table id="tbl-data-kritis" class="table table-striped table-bordered table-hover">
            <thead class="text-uppercase" style="font-size: 12px;">
              <tr>
                <th scope="col">Itemcode</th>
                <th scope="col">Part no</th>
                <th scope="col">Part name</th>
                <th scope="col">Stock</th>
                <th scope="col">Min</th>
                <th scope="col">Max</th>
              </tr>
            </thead>
            <tbody>
              <!-- Data rows will go here -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
