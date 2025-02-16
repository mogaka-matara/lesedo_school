@extends('admin.layouts.master')
@section('title', 'Fee Collections')

@section('content')



    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">
            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
                <div class="my-auto mb-2">
                    <h3 class="page-title mb-1">Invoices</h3>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="index.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Finance & Accounts</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Invoices</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                    <div class="pe-1 mb-2">
                        <a href="accounts-invoices.html#" class="btn btn-outline-light bg-white btn-icon me-1" data-bs-toggle="tooltip"
                           data-bs-placement="top" aria-label="Refresh" data-bs-original-title="Refresh">
                            <i class="ti ti-refresh"></i>
                        </a>
                    </div>
                    <div class="pe-1 mb-2">
                        <button type="button" class="btn btn-outline-light bg-white btn-icon me-1"
                                data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Print"
                                data-bs-original-title="Print">
                            <i class="ti ti-printer"></i>
                        </button>
                    </div>
                    <div class="dropdown me-2 mb-2">
                        <a href="javascript:void(0);"
                           class="dropdown-toggle btn btn-light fw-medium d-inline-flex align-items-center"
                           data-bs-toggle="dropdown">
                            <i class="ti ti-file-export me-2"></i>Export
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end p-3">
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item rounded-1"><i
                                        class="ti ti-file-type-pdf me-1"></i>Export as PDF</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item rounded-1"><i
                                        class="ti ti-file-type-xls me-1"></i>Export as Excel </a>
                            </li>
                        </ul>
                    </div>
                    <div class="mb-2">
                        <a href="add-invoice.html" class="btn btn-primary d-flex align-items-center"><i class="ti ti-square-rounded-plus me-2"></i>Add
                            Invoices</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Filter Section -->

                    <!-- Invoice List -->
                    {{ $dataTable->table() }}

                    <!-- /Invoice List -->

        </div>
    </div>
    <!-- /Page Wrapper -->

    <!-- View Modal -->
    <div class="modal fade" id="view_invoice">
        <div class="modal-dialog modal-dialog-centered modal-xl invoice-modal">
            <div class="modal-content">
                <div class="modal-wrapper">
                    <div class="invoice-popup-head d-flex align-items-center justify-content-between mb-4">
                        <span><img src="backend/assets/img/logo.svg" alt="Img"></span>
                        <div class="popup-title">
                            <h2>LESSDI ACADEMY</h2>
                            <p>Original For Recipient</p>
                        </div>
                    </div>
                    <div class="tax-info mb-2">
                        <div class="mb-4 text-center">
                            <h1>Fee Payment Receipt</h1>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="tax-invoice-info d-flex align-items-center justify-content-between">
                                    <h5>Student Name :</h5>
                                    <h6 id="student-name"></h6>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="tax-invoice-info d-flex align-items-center justify-content-between">
                                    <h5>Reference Number :</h5>
                                    <h6 id="reference"></h6>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="tax-invoice-info d-flex align-items-center justify-content-between">
                                    <h5>Term :</h5>
                                    <h6 id="term"></h6>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="tax-invoice-info d-flex align-items-center justify-content-between">
                                    <h5>Invoice No :</h5>
                                    <h6 id="invoice-no"></h6>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="tax-invoice-info d-flex align-items-center justify-content-between">
                                    <h5>Invoice Date :</h5>
                                    <h6 id="invoice-date"></h6>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="tax-invoice-info d-flex align-items-center justify-content-between">
                                    <h5>Payment Date :</h5>
                                    <h6 id="payment-date"></h6>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h6 class="mb-1">Payment By :</h6>
                            <p id="bill-to"></p>
                        </div>
                        <div class="invoice-product-table">
                            <div class="table-responsive invoice-table">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody id="invoice-items">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <h5 class="mb-1">Total amount (in words):</h5>
                                    <p id="total-amount-words" class="text-dark fw-medium"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="total-amount-tax mb-3">
                                    <ul class="total-amount">
                                        <li class="text-dark">Amount Paid</li>
                                    </ul>
                                    <ul class="total-amount">
                                        <li id="amount-payable" class="text-dark"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="payment-info">
                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-4 pt-4">
                                    <h5 class="mb-2">Payment Info:</h5>
                                    <p class="mb-1">Payment Mode : <span id="payment-mode" class="fw-medium text-dark"></span></p>
                                </div>
                                <div class="col-lg-6 text-end mb-4 pt-4">
                                    <h6 class="mb-2">Signed By</h6>
                                    <img src="backend/assets/img/icons/signature.svg" alt="Img">
                                </div>
                            </div>
                        </div>
                        <div class="border-bottom text-center pt-4 pb-4">
                            <span class="text-dark fw-medium">Terms & Conditions : </span>
                            <p id="terms-conditions"></p>
                        </div>
                        <p class="text-center pt-3">Thanks for your Business</p>
                    </div>
                </div>

                <div class="modal-footer">
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>    <!-- /View Modal -->




@endsection


@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).on('click', '.view-invoice', function () {
            let invoiceId = $(this).data('id'); // Get the invoice ID

            // Find the corresponding invoice in the feeInvoice array
            let selectedInvoice = @json($feeInvoice); // Convert PHP variable to JSON
            let invoice = selectedInvoice.find(inv => inv.invoice_id === invoiceId);

            let invoiceDate = new Date(invoice.created_at);

            let formattedDate = invoiceDate.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            if (invoice) {
                // Populate the modal fields
                $('#student-name').text(invoice.student.first_name + " " + invoice.student.last_name );
                $('#reference').text(invoice.receipt_number );
                $('#term').text(invoice.term.name);
                $('#invoice-no').text(invoice.invoice_id );
                $('#invoice-date').text(formattedDate);
                $('#payment-date').text(invoice.payment_date || 'N/A');
                $('#bill-to').html(`
                <span class="text-dark">${invoice.student.parent_name}</span> <br>
                ${invoice.student.address} <br>
                ${invoice.student.parent_email} <br>
                ${invoice.student.parent_contact }
            `);
                $('#important-note').text(invoice.important_note || 'N/A');
                $('#total-amount-words').text(invoice.total_amount_words || 'N/A');
                $('#amount-payable').text('KES' + (invoice.amount || 0).toFixed(2));
                $('#payment-mode').text(invoice.payment_mode);
                $('#payment-amount').text('KES' + (invoice.payment_info?.amount || 0).toFixed(2));
                $('#terms-conditions').text(invoice.terms_conditions || 'N/A');

                // Populate the invoice items table
                let invoiceItemsHtml = '';
                invoice.items.forEach(item => {
                    invoiceItemsHtml += `
                    <tr>
                        <td>${item.description}</td>
                        <td>$${item.amount.toFixed(2)}</td>
                    </tr>
                `;
                });
                $('#invoice-items').html(invoiceItemsHtml);
            } else {
                alert('Invoice not found.');
            }
        });
    </script>





@endpush




