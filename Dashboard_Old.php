 
<?php  include 'header.php';  ?>
<div class="wrapper demo-wrapper">
    <div class="main">
        <div class="section section-nude">
            <div class="container tim-container">
              <!--   <div class="tim-title">
                    <h3>Tables</h3>
                </div> -->

                <div class="row">
                    <div class="col-md-12">
                        <h4>Simple Table</h4>
                    </div>
                    <div class="col-md-8 col-md-offset-2">
                    <h4><small>Simple With Actions</small></h4>
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th>Job Position</th>
                                    <th>Since</th>
                                    <th class="text-right">Salary</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>Andrew Mike</td>
                                    <td>Develop</td>
                                    <td>2013</td>
                                    <td class="text-right">&euro; 99,225</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="View Profile" class="btn btn-info btn-simple btn-sm">
                                            <i class="fa fa-user"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Edit Profile" class="btn btn-success btn-simple btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-sm">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>

                                    <td class="text-center">2</td>
                                    <td>John Doe</td>
                                    <td>Design</td>
                                    <td>2012</td>
                                    <td class="text-right">&euro; 89,241</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="View Profile" class="btn btn-info btn-simple btn-sm">
                                            <i class="fa fa-user"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Edit Profile" class="btn btn-success btn-simple btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-sm">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>Alex Mike</td>
                                    <td>Design</td>
                                    <td>2010</td>
                                    <td class="text-right">&euro; 92,144</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="View Profile" class="btn btn-info btn-simple btn-sm">
                                            <i class="fa fa-user"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Edit Profile" class="btn btn-success btn-simple btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-sm">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td>Mike Monday</td>
                                    <td>Marketing</td>
                                    <td>2013</td>
                                    <td class="text-right">&euro; 49,990</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="View Profile" class="btn btn-info btn-simple btn-sm">
                                            <i class="fa fa-user"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Edit Profile" class="btn btn-success btn-simple btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-sm">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">5</td>
                                    <td>Paul Dickens</td>
                                    <td>Communication</td>
                                    <td>2016</td>
                                    <td class="text-right">&euro; 69,201</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="View Profile" class="btn btn-info btn-simple btn-sm">
                                            <i class="fa fa-user"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Edit Profile" class="btn btn-success btn-simple btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-sm">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>

                        <h4><small>Striped With Checkboxes</small></h4>
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th></th>
                                    <th>Product Name</th>
                                    <th>Type</th>
                                    <th>Qty</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>
                                        <label class="checkbox">
                                            <input type="checkbox" value="" data-toggle="checkbox">
                                        </label>
                                    </td>
                                    <td>Moleskine Agenda</td>
                                    <td>Office</td>
                                    <td>25</td>
                                    <td class="text-right">&euro; 49</td>
                                    <td class="text-right">&euro; 1,225</td>
                                </tr>
                                <tr>

                                    <td class="text-center">2</td>
                                    <td>
                                        <label class="checkbox">
                                            <input type="checkbox" value="" data-toggle="checkbox" checked="">
                                        </label>
                                    </td>
                                    <td>Stabilo Pen</td>
                                    <td>Office</td>
                                    <td>30</td>
                                    <td class="text-right">&euro; 10</td>
                                    <td class="text-right">&euro; 300</td>
                                </tr>
                                <tr>

                                    <td class="text-center">3</td>
                                    <td>
                                        <label class="checkbox">
                                            <input type="checkbox" value="" data-toggle="checkbox" checked="">
                                        </label>
                                    </td>
                                    <td>A4 Paper Pack</td>
                                    <td>Office</td>
                                    <td>50</td>
                                    <td class="text-right">&euro; 10.99</td>
                                    <td class="text-right">&euro; 109</td>
                                </tr>
                                <tr>

                                    <td class="text-center">4</td>
                                    <td>
                                        <label class="checkbox">
                                            <input type="checkbox" value="" data-toggle="checkbox">
                                        </label>
                                    </td>
                                    <td>Apple iPad</td>
                                    <td>Meeting</td>
                                    <td>10</td>
                                    <td class="text-right">&euro; 499.00</td>
                                    <td class="text-right">&euro; 4,990</td>
                                </tr>
                                <tr>

                                    <td class="text-center">5</td>
                                    <td>
                                        <label class="checkbox">
                                            <input type="checkbox" value="" data-toggle="checkbox">
                                        </label>
                                    </td>
                                    <td>Apple iPhone</td>
                                    <td>Communication</td>
                                    <td>10</td>
                                    <td class="text-right">&euro; 599.00</td>
                                    <td class="text-right">&euro; 5,999</td>
                                </tr>
                                <tr>
                                    <td colspan="5"></td>
                                    <td class="td-total">
                                        Total
                                    </td>
                                    <td class="td-price">
                                        <small>&euro;</small>12,999
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Shopping Cart Table</h4>
                    </div>
                    <div class="col-md-10 col-md-offset-1">
                        <div class="table-responsive">
                        <table class="table table-shopping">
                            <thead>
                                <tr>
                                    <th class="text-center"></th>
                                    <th></th>
                                    <th class="text-right">Price</th>
                                    <th class="text-right">Quantity</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="img-container">
                                            <img src="assets/img/tables/agenda.png" alt="Agenda">
                                        </div>
                                    </td>
                                    <td class="td-product">
                                        <strong>Get Shit Done Notebook</strong>
                                        <p>
                                        Most beautiful agenda for the office, really nice paper and black cover. Most beautiful agenda for the office.</p>
                                    </td>

                                    <td class="td-price">
                                        <small>&euro;</small>49
                                    </td>
                                    <td class="td-number td-quantity">
                                        1
                                        <div class="btn-group">
                                            <button class="btn btn-sm"> - </button>
                                            <button class="btn btn-sm"> + </button>
                                        </div>
                                    </td>
                                    <td class="td-number">
                                        <small>&euro;</small>49
                                    </td>
                                </tr>
                                <tr>
                                     <td>
                                        <div class="img-container">
                                            <img src="assets/img/tables/stylus.jpg" alt="Stylus"/>
                                        </div>
                                    </td>
                                    <td class="td-product">
                                        <strong>Stylus</strong>
                                        <p>Design is not just what it looks like and feels like. Design is how it works.  </p>
                                    </td>

                                    <td class="td-price">
                                        <small>&euro;</small>499
                                    </td>
                                    <td class="td-number td-quantity">
                                        2
                                        <div class="btn-group">
                                            <button class="btn btn-sm"> - </button>
                                            <button class="btn btn-sm"> + </button>
                                        </div>
                                    </td>
                                    <td class="td-number">
                                        <small>&euro;</small>998
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="img-container">
                                            <img src="assets/img/tables/evernote.png" alt="Evernote">
                                        </div>
                                    </td>
                                    <td class="td-product">
                                        <strong>Evernote iPad Stander</strong>
                                        <p>A groundbreaking Retina display. All-flash architecture. Fourth-generation Intel processors.</p>
                                    </td>

                                    <td class="td-price">
                                        <small>&euro;</small>799
                                    </td>
                                    <td class="td-number td-quantity">
                                        1
                                        <div class="btn-group">
                                            <button class="btn btn-sm"> - </button>
                                            <button class="btn btn-sm"> + </button>
                                        </div>
                                    </td>
                                    <td class="td-number">
                                        <small>&euro;</small>799
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td></td>
                                    <td class="td-total">
                                       Total
                                    </td>
                                    <td class="td-total">
                                        <small>&euro;</small>12,999
                                    </td>
    <!--
                                    <td> <button type="button" class="btn btn-info btn-fill btn-l">Complete Purchase <i class="fa fa-chevron-right"></i></button></td>

                                    <td></td>
    -->
                                </tr>
                                <tr class="tr-actions">
                                   <td colspan="3"></td>
                                   <td colspan="2" class="text-right">
                                       <button type="button" class="btn btn-danger btn-fill btn-lg">Complete Purchase <i class="fa fa-chevron-right"></i></button>
                                   </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    

<?php  include 'footer.php';  ?>
