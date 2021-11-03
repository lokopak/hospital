          <div class="row row-cols-2 row-cols-md-4 card-group g-4 mb-5">
              <!-- Count item widget-->
              <div class="col">
                  <div class="card text-white bg-primary">
                      <div class="card-body d-flex">
                          <i class="fa fa-users fa-2x"></i>
                          <div class="ms-3">
                              <h3 class="h4 text-uppercase fw-normal">Nuevos Pacientes</h3>
                              <p class="text-gray-400 small">Últimos 7 días</p>
                              <p class="display-6 mb-0">25</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col">
                  <div class="card text-white bg-success">
                      <div class="card-body d-flex">
                          <i class="fa fa-users fa-2x"></i>
                          <div class="ms-3">
                              <h3 class="h4 text-uppercase fw-normal">Altas</h3>
                              <p class="text-gray-400 small">Últimos 7 días</p>
                              <p class="display-6 mb-0">15</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col">
                  <div class="card text-white bg-danger">
                      <div class="card-body d-flex">
                          <i class="fa fa-users fa-2x"></i>
                          <div class="ms-3">
                              <h3 class="h4 text-uppercase fw-normal">Defunciones</h3>
                              <p class="text-gray-200 small">Últimos 7 días</p>
                              <p class="display-6 mb-0">2</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col">
                  <div class="card text-white bg-warning">
                      <div class="card-body d-flex">
                          <i class="fa fa-users fa-2x"></i>
                          <div class="ms-3">
                              <h3 class="h4 text-uppercase fw-normal">Nuevos Informes</h3>
                              <p class="text-gray-700 small">Últimos 7 días</p>
                              <p class="display-6 mb-0">50</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="card">
                  <div class="card-header border-bottom">
                      <h3 class="h4 mb-0">Basic Table</h3>
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
                          <table class="table text-sm mb-0">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>First Name</th>
                                      <th>Last Name</th>
                                      <th>Username</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <th scope="row">1</th>
                                      <td>Mark</td>
                                      <td>Otto</td>
                                      <td>@mdo</td>
                                  </tr>
                                  <tr>
                                      <th scope="row">2</th>
                                      <td>Jacob</td>
                                      <td>Thornton</td>
                                      <td>@fat</td>
                                  </tr>
                                  <tr>
                                      <th class="border-bottom-0" scope="row">3</th>
                                      <td class="border-bottom-0">Larry</td>
                                      <td class="border-bottom-0">the Bird</td>
                                      <td class="border-bottom-0">@twitter</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>

          <!-- FORMS -->

          <div class="row">
              <!-- Basic Form-->
              <div class="col-lg-6">
                  <div class="card">
                      <div class="card-header border-bottom">
                          <h3 class="h4 mb-0">Basic Form</h3>
                      </div>
                      <div class="card-body">
                          <p class="text-sm">Lorem ipsum dolor sit amet consectetur.</p>
                          <form>
                              <div class="mb-3">
                                  <label class="form-label" for="exampleInputEmail1">Email address</label>
                                  <input class="form-control" id="exampleInputEmail1" type="email"
                                      aria-describedby="emailHelp">
                                  <div class="form-text" id="emailHelp">We'll never share your email with anyone else.
                                  </div>
                              </div>
                              <div class="mb-3">
                                  <label class="form-label" for="exampleInputPassword1">Password</label>
                                  <input class="form-control" id="exampleInputPassword1" type="password">
                              </div>
                              <button class="btn btn-primary" type="submit">Submit</button>
                          </form>
                      </div>
                  </div>
              </div>
              <!-- Horizontal Form-->
              <div class="col-lg-6">
                  <div class="card">
                      <div class="card-header border-bottom">
                          <h3 class="h4 mb-0">Horizontal Form</h3>
                      </div>
                      <div class="card-body">
                          <p class="text-sm">Lorem ipsum dolor sit amet consectetur.</p>
                          <form class="form-horizontal">
                              <div class="row gy-2 mb-4">
                                  <label class="col-sm-3 form-label" for="inputHorizontalElOne">Email</label>
                                  <div class="col-sm-9">
                                      <input class="form-control" id="inputHorizontalElOne" type="email"
                                          placeholder="Email Address"><small class="form-text">Example help text that
                                          remains
                                          unchanged.</small>
                                  </div>
                              </div>
                              <div class="row gy-2 mb-4">
                                  <label class="col-sm-3 form-label" for="inputHorizontalElTwo">Password</label>
                                  <div class="col-sm-9">
                                      <input class="form-control" id="inputHorizontalElTwo" type="password"
                                          placeholder="Pasword"><small class="form-text">Example help text that remains
                                          unchanged.</small>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-9 ms-auto">
                                      <input class="btn btn-primary" type="submit" value="Signin">
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
              <!-- Inline Form-->
              <div class="col-lg-8">
                  <div class="card">
                      <div class="card-header border-bottom">
                          <h3 class="h4 mb-0">Inline Form</h3>
                      </div>
                      <div class="card-body">
                          <form class="row g-3 align-items-center">
                              <div class="col-lg">
                                  <label class="visually-hidden" for="inlineFormInputGroupUsername">Username</label>
                                  <div class="input-group">
                                      <div class="input-group-text">@</div>
                                      <input class="form-control" id="inlineFormInputGroupUsername" type="text"
                                          placeholder="Username">
                                  </div>
                              </div>
                              <div class="col-lg">
                                  <label class="visually-hidden" for="inlineFormSelectPref">Preference</label>
                                  <select class="form-select" id="inlineFormSelectPref">
                                      <option selected>Choose...</option>
                                      <option value="1">One</option>
                                      <option value="2">Two</option>
                                      <option value="3">Three</option>
                                  </select>
                              </div>
                              <div class="col-lg">
                                  <button class="btn btn-primary" type="submit">Submit</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
              <!-- Modal Form-->
              <div class="col-lg-4">
                  <div class="card">
                      <div class="card-header border-bottom">
                          <h3 class="mb-0">Signin Modal</h3>
                      </div>
                      <div class="card-body text-center">
                          <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                              data-bs-target="#myModal">Form in
                              simple modal </button>
                          <!-- Modal-->
                          <div class="modal fade text-start" id="myModal" tabindex="-1" aria-labelledby="myModalLabel"
                              aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="myModalLabel">Modal Form</h5>
                                          <button class="btn-close" type="button" data-bs-dismiss="modal"
                                              aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                          <p>Lorem ipsum dolor sit amet consectetur.</p>
                                          <form>
                                              <div class="mb-3">
                                                  <label class="form-label" for="modalInputEmail1">Email address</label>
                                                  <input class="form-control" id="modalInputEmail1" type="email"
                                                      aria-describedby="emailHelp">
                                                  <div class="form-text" id="emailHelp">We'll never share your email
                                                      with anyone
                                                      else.</div>
                                              </div>
                                              <div class="mb-3">
                                                  <label class="form-label" for="modalInputPassword1">Password</label>
                                                  <input class="form-control" id="modalInputPassword1" type="password">
                                              </div>
                                          </form>
                                      </div>
                                      <div class="modal-footer">
                                          <button class="btn btn-secondary" type="button"
                                              data-bs-dismiss="modal">Close</button>
                                          <button class="btn btn-primary" type="button">Save changes</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- Form Elements -->
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-header border-bottom">
                          <h3 class="h4 mb-0">All form elements</h3>
                      </div>
                      <div class="card-body">
                          <form class="form-horizontal">
                              <div class="row">
                                  <label class="col-sm-3 form-label">Normal</label>
                                  <div class="col-sm-9">
                                      <input class="form-control" type="text">
                                  </div>
                              </div>
                              <div class="border-bottom my-5 border-gray-200"></div>
                              <div class="row">
                                  <label class="col-sm-3 form-label">Help text</label>
                                  <div class="col-sm-9">
                                      <input class="form-control" type="text"><small class="form-text">A block of help
                                          text that
                                          breaks onto a new line and may extend beyond one line.</small>
                                  </div>
                              </div>
                              <div class="border-bottom my-5 border-gray-200"></div>
                              <div class="row">
                                  <label class="col-sm-3 form-label">Password</label>
                                  <div class="col-sm-9">
                                      <input class="form-control" type="password" name="password">
                                  </div>
                              </div>
                              <div class="border-bottom my-5 border-gray-200"></div>
                              <div class="row">
                                  <label class="col-sm-3 form-label">Placeholder</label>
                                  <div class="col-sm-9">
                                      <input class="form-control" type="text" placeholder="placeholder">
                                  </div>
                              </div>
                              <div class="border-bottom my-5 border-gray-200"></div>
                              <div class="row">
                                  <label class="col-sm-3 form-label">Disabled</label>
                                  <div class="col-sm-9">
                                      <input class="form-control" type="text" disabled=""
                                          placeholder="Disabled input here...">
                                  </div>
                              </div>
                              <div class="border-bottom my-5 border-gray-200"></div>
                              <div class="row">
                                  <label class="col-sm-3 form-label">Checkboxes &amp; radios </label>
                                  <div class="col-sm-9">
                                      <div class="form-check">
                                          <input class="form-check-input" id="defaultCheck0" type="checkbox">
                                          <label class="form-check-label" for="defaultCheck0">Option one</label>
                                      </div>
                                      <div class="form-check">
                                          <input class="form-check-input" id="defaultCheck1" type="checkbox" checked>
                                          <label class="form-check-label" for="defaultCheck1">Option two checked</label>
                                      </div>
                                      <div class="form-check">
                                          <input class="form-check-input" id="defaultCheck2" type="checkbox" checked
                                              disabled>
                                          <label class="form-check-label" for="defaultCheck2">Option three checked and
                                              disabled</label>
                                      </div>
                                      <div class="form-check">
                                          <input class="form-check-input" id="defaultCheck3" type="checkbox" disabled>
                                          <label class="form-check-label" for="defaultCheck3">Option four
                                              disabled</label>
                                      </div>
                                      <div class="form-check">
                                          <input class="form-check-input" id="defaultRadio0" type="radio"
                                              name="exampleRadios">
                                          <label class="form-check-label" for="defaultRadio0">Option one</label>
                                      </div>
                                      <div class="form-check">
                                          <input class="form-check-input" id="defaultRadio1" type="radio"
                                              name="exampleRadios" checked>
                                          <label class="form-check-label" for="defaultRadio1">Option two checked</label>
                                      </div>
                                      <div class="form-check">
                                          <input class="form-check-input" id="defaultRadio2" type="radio"
                                              name="exampleRadios" checked disabled>
                                          <label class="form-check-label" for="defaultRadio2">Option three checked and
                                              disabled</label>
                                      </div>
                                      <div class="form-check">
                                          <input class="form-check-input" id="defaultRadio3" type="radio"
                                              name="exampleRadios" disabled>
                                          <label class="form-check-label" for="defaultRadio3">Option four
                                              disabled</label>
                                      </div>
                                  </div>
                              </div>
                              <div class="border-bottom my-5 border-gray-200"></div>
                              <div class="row">
                                  <label class="col-sm-3 form-label">Select</label>
                                  <div class="col-sm-9">
                                      <select class="form-select mb-3" name="account">
                                          <option>option 1</option>
                                          <option>option 2</option>
                                          <option>option 3</option>
                                          <option>option 4</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-9 offset-sm-3">
                                      <select class="form-select" multiple="">
                                          <option>option 1</option>
                                          <option>option 2</option>
                                          <option>option 3</option>
                                          <option>option 4</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="border-bottom my-5 border-gray-200"></div>
                              <div class="row">
                                  <label class="col-sm-3 form-label" for="formFile">File input</label>
                                  <div class="col-sm-9">
                                      <input class="form-control" id="formFile" type="file">
                                  </div>
                              </div>
                              <div class="border-bottom my-5 border-gray-200"></div>
                              <div class="row">
                                  <label class="col-sm-3 form-label">Input with success</label>
                                  <div class="col-sm-9">
                                      <input class="form-control is-valid" type="text">
                                      <div class="valid-feedback">Looks good!</div>
                                  </div>
                              </div>
                              <div class="border-bottom my-5 border-gray-200"></div>
                              <div class="row">
                                  <label class="col-sm-3 form-label">Input with error</label>
                                  <div class="col-sm-9">
                                      <input class="form-control is-invalid" type="text">
                                      <div class="invalid-feedback">Please provide your name.</div>
                                  </div>
                              </div>
                              <div class="border-bottom my-5 border-gray-200"></div>
                              <div class="row">
                                  <label class="col-sm-3 form-label">Control sizing</label>
                                  <div class="col-sm-9">
                                      <input class="form-control form-control-lg mb-3" type="text"
                                          placeholder=".input-lg">
                                      <input class="form-control mb-3" type="text" placeholder="Default input">
                                      <input class="form-control form-control-sm mb-3" type="text"
                                          placeholder=".input-sm">
                                  </div>
                              </div>
                              <div class="border-bottom my-5 border-gray-200"></div>
                              <div class="row">
                                  <label class="col-sm-3 form-label">Column sizing</label>
                                  <div class="col-sm-9">
                                      <div class="row">
                                          <div class="col-md-3">
                                              <input class="form-control" type="text" placeholder=".col-md-3">
                                          </div>
                                          <div class="col-md-4">
                                              <input class="form-control" type="text" placeholder=".col-md-4">
                                          </div>
                                          <div class="col-md-5">
                                              <input class="form-control" type="text" placeholder=".col-md-5">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="border-bottom my-5 border-gray-200"> </div>
                              <div class="row">
                                  <label class="col-sm-3 form-label">Material Inputs</label>
                                  <div class="col-sm-9">
                                      <div class="input-material-group mb-3">
                                          <input class="input-material" id="register-username" type="text"
                                              name="registerUsername" required value="Jason Doe">
                                          <label class="label-material" for="register-username">Username</label>
                                      </div>
                                      <div class="input-material-group mb-3">
                                          <input class="input-material" id="register-email" type="email"
                                              name="registerEmail" required>
                                          <label class="label-material" for="register-email">Email Address </label>
                                      </div>
                                      <div class="input-material-group mb-3">
                                          <input class="input-material" id="register-password" type="password"
                                              name="registerPassword" required>
                                          <label class="label-material" for="register-password">Password </label>
                                      </div>
                                  </div>
                              </div>
                              <div class="border-bottom my-5 border-gray-200"></div>
                              <div class="row">
                                  <label class="col-sm-3 form-label">Input groups</label>
                                  <div class="col-sm-9">
                                      <div class="input-group mb-3"><span class="input-group-text"
                                              id="basic-addon1">@</span>
                                          <input class="form-control" type="text" placeholder="Username"
                                              aria-label="Username" aria-describedby="basic-addon1">
                                      </div>
                                      <div class="input-group mb-3">
                                          <input class="form-control" type="text" placeholder="Username"
                                              aria-label="Username" aria-describedby="basic-addon2"><span
                                              class="input-group-text" id="basic-addon2">@</span>
                                      </div>
                                      <div class="input-group mb-3">
                                          <div class="input-group-text">
                                              <input class="form-check-input mt-0" type="checkbox"
                                                  aria-label="Checkbox for following text input">
                                          </div>
                                          <input class="form-control" type="text" aria-label="Text input with checkbox">
                                      </div>
                                      <div class="input-group mb-3">
                                          <input class="form-control" type="text"
                                              aria-label="Text input with radio button">
                                          <div class="input-group-text">
                                              <input class="form-check-input mt-0" type="radio"
                                                  aria-label="Radio button for following text input">
                                          </div>
                                      </div>
                                      <div class="input-group mb-3"><span class="input-group-text">$</span><span
                                              class="input-group-text">0.00</span>
                                          <input class="form-control" type="text"
                                              aria-label="Dollar amount (with dot and two decimal places)">
                                      </div>
                                      <div class="input-group">
                                          <input class="form-control" type="text"
                                              aria-label="Dollar amount (with dot and two decimal places)"><span
                                              class="input-group-text">$</span><span
                                              class="input-group-text">0.00</span>
                                      </div>
                                  </div>
                              </div>
                              <div class="border-bottom my-5 border-gray-200"></div>
                              <div class="row">
                                  <label class="col-sm-3 form-label">Button addons</label>
                                  <div class="col-sm-9">
                                      <div class="input-group mb-3">
                                          <button class="btn btn-primary" id="button-addon1"
                                              type="button">Button</button>
                                          <input class="form-control" type="text" placeholder
                                              aria-label="Example text with button addon"
                                              aria-describedby="button-addon1">
                                      </div>
                                      <div class="input-group">
                                          <input class="form-control" type="text" placeholder="Recipient's username"
                                              aria-label="Recipient's username" aria-describedby="button-addon2">
                                          <button class="btn btn-primary" id="button-addon2"
                                              type="button">Button</button>
                                      </div>
                                  </div>
                              </div>
                              <div class="border-bottom my-5 border-gray-200"></div>
                              <div class="row">
                                  <label class="col-sm-3 form-label">With dropdowns</label>
                                  <div class="col-sm-9">
                                      <div class="input-group">
                                          <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                              data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
                                          <ul class="dropdown-menu shadow-sm">
                                              <li><a class="dropdown-item" href="#!">Action</a></li>
                                              <li><a class="dropdown-item" href="#!">Another action</a></li>
                                              <li><a class="dropdown-item" href="#!">Something else here</a></li>
                                              <li><a class="dropdown-item" href="#!">Separated link</a></li>
                                          </ul>
                                          <input class="form-control" type="text"
                                              aria-label="Text input with dropdown button">
                                      </div>
                                  </div>
                              </div>
                              <div class="border-bottom my-5 border-gray-200"></div>
                              <div class="row">
                                  <div class="col-sm-9 ms-auto">
                                      <button class="btn btn-secondary" type="reset">Cancel</button>
                                      <button class="btn btn-primary" type="submit">Save changes</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>