                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
<div id="fb-root"></div>
<!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "109019861636652");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v12.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
            <!-- Footer -->
            <footer id="page-footer" class="footer-static bg-white">
                <div class="content py-4">
                    <!-- Footer Navigation -->
                    <div class="row items-push font-size-sm border-bottom pt-4">
                        <div class="col-md-4">
                            <h3 class="h5 font-w700"><?= $JTech->setting('website_name'); ?></h3>
                            <div>
                                <p class="text-muted"><?= $JTech->setting('description'); ?></p>
                                
                                Hotline: <b><?= $JTech->setting('hotline'); ?></b> <br>
                                Email: <b><?= $JTech->setting('email_admin'); ?></b>
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3 class="h5 font-w700">Thông tin</h3>
                            <div>
                                <ul style="padding: 16px; margin: 0; margin-top: -16px;">
                                    <li>
                                        Làm việc: <b><?= $JTech->setting('work_time'); ?></b>
                                    </li>
                                    <?php
                                        foreach(explode("\n", $JTech->setting('info_url')) as $url) {
                                    ?>
                                    <hr>
                                    <li>
                                        <a href="<?= $url; ?>"><?= $url; ?></a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3 class="h5 font-w700">Liên kết mạng xã hội</h3>
                            <div>
                                <?php if($JTech->setting('facebook_url') != "") { ?>
                                <a class="btn btn-hero-primary" href="<?= $JTech->setting('facebook_url'); ?>"><i class="fab fa-facebook"></i></a>
                                <?php } ?>
                                <?php if($JTech->setting('youtube_url') != "") { ?>
                                <a class="btn btn-hero-danger" href="<?= $JTech->setting('youtube_url'); ?>"><i class="fab fa-youtube"></i></a>
                                <?php } ?>
                                <?php if($JTech->setting('website_url') != "") { ?>
                                <a class="btn btn-hero-info" href="<?= $JTech->setting('website_url'); ?>"><i class="fas fa-globe"></i></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- END Footer Navigation -->

                    <!-- Footer Copyright -->
                    <div class="row font-size-sm pt-4">
                        <div class="col-sm-6 order-sm-2 mb-1 mb-sm-0 text-center text-sm-right">
                            Developed with <i class="fa fa-heart text-danger"></i> by <a class="font-w600" href="<?= $JTech->setting('info_url'); ?>" target="_blank"><?= $JTech->setting('website_name'); ?></a>
                        </div>
                        <div class="col-sm-6 order-sm-1 text-center text-sm-left"><a class="font-w600" href="javascript:;">All Copyrights Reserved</a> &copy; <span data-toggle="year-copy"></span></div>
                    </div>
                    <!-- END Footer Copyright -->
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <?= $JTech->setting('plugin_script'); ?>

        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/script.js?<?= time(); ?>"></script>


        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/dashmix.core.min.js"></script>

        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/dashmix.app.min.js"></script>

        <?php if(isset($required_datatable)) { ?>
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/plugins/datatables/buttons/dataTables.buttons.min.js"></script>
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/plugins/datatables/buttons/buttons.print.min.js"></script>
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/plugins/datatables/buttons/buttons.html5.min.js"></script>
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/plugins/datatables/buttons/buttons.flash.min.js"></script>
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/plugins/datatables/buttons/buttons.colVis.min.js"></script>
        <!-- <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/pages/be_tables_datatables.min.js"></script> -->
        <script>
            ! function() {
                function e(e, a) {
                    for (var t = 0; t < a.length; t++) {
                        var n = a[t];
                        n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
                    }
                }
                var a = function() {
                    function a() {
                        ! function(e, a) {
                            if (!(e instanceof a)) throw new TypeError("Cannot call a class as a function")
                        }(this, a)
                    }
                    var t, n;
                    return t = a, n = [{
                        key: "initDataTables",
                        value: function() {
                            jQuery.extend(jQuery.fn.dataTable.ext.classes, {
                                sWrapper: "dataTables_wrapper dt-bootstrap4",
                                sFilterInput: "form-control",
                                sLengthSelect: "form-control"
                            }), jQuery.extend(!0, jQuery.fn.dataTable.defaults, {
                                language: {
                                    lengthMenu: "_MENU_",
                                    search: "_INPUT_",
                                    searchPlaceholder: "Search..",
                                    info: "Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",
                                    paginate: {
                                        first: '<i class="fa fa-angle-double-left"></i>',
                                        previous: '<i class="fa fa-angle-left"></i>',
                                        next: '<i class="fa fa-angle-right"></i>',
                                        last: '<i class="fa fa-angle-double-right"></i>'
                                    }
                                }
                            }), jQuery(".js-dataTable-full").dataTable({
                                pageLength: 3,
                                lengthMenu: [
                                    [3, 5, 10, 20, 50],
                                    [3, 5, 10, 20, 50]
                                ],
                                autoWidth: !1,
                                ordering: false
                            }), jQuery(".js-dataTable-buttons").dataTable({
                                pageLength: 5,
                                lengthMenu: [
                                    [5, 10, 20],
                                    [5, 10, 20]
                                ],
                                autoWidth: !1,
                                buttons: [{
                                    extend: "copy",
                                    className: "btn btn-sm btn-primary"
                                }, {
                                    extend: "csv",
                                    className: "btn btn-sm btn-primary"
                                }, {
                                    extend: "print",
                                    className: "btn btn-sm btn-primary"
                                }],
                                dom: "<'row'<'col-sm-12'<'text-center bg-body-light py-2 mb-2'B>>><'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
                            }), jQuery(".js-dataTable-full-pagination").dataTable({
                                pagingType: "full_numbers",
                                pageLength: 5,
                                lengthMenu: [
                                    [5, 10, 20],
                                    [5, 10, 20]
                                ],
                                autoWidth: !1
                            }), jQuery(".js-dataTable-simple").dataTable({
                                pageLength: 5,
                                lengthMenu: !1,
                                searching: !1,
                                autoWidth: !1,
                                dom: "<'row'<'col-sm-12'tr>><'row'<'col-sm-6'i><'col-sm-6'p>>"
                            })
                        }
                    }, {
                        key: "init",
                        value: function() {
                            this.initDataTables()
                        }
                    }], null && e(t.prototype, null), n && e(t, n), a
                }();
                jQuery((function() {
                    a.init()
                }))
            }();
        </script>
        <?php } ?>
        
        <?php if(isset($wizard_form)) { ?>
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js"></script>
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/plugins/jquery-validation/additional-methods.js"></script>
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/pages/be_forms_wizard.min.js"></script>
        <?php } ?>

        <?php if(isset($select2)) { ?>
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/plugins/select2/js/select2.full.min.js"></script>
        <script>
            jQuery(function(){ Dashmix.helpers(['select2']); });
        </script>
        <?php } ?>
        <?php if(isset($code_bg)) { ?>
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/plugins/highlight/highlight.min.js"></script>
        <script>
            hljs.debugMode();
                hljs.highlightAll();

                document.querySelectorAll(".categories > li").forEach((category) => {
                category.addEventListener("click", (event) => {
                    const current = document.querySelector(".categories .current");
                    const currentCategory = current.dataset.category;
                    const nextCategory = event.target.dataset.category;

                    if (currentCategory !== nextCategory) {
                    current.classList.remove("current");
                    event.target.classList.add("current");

                    document
                        .querySelectorAll(`.${currentCategory}`)
                        .forEach((language) => language.classList.add("hidden"));
                    document
                        .querySelectorAll(`.${nextCategory}`)
                        .forEach((language) => language.classList.remove("hidden"));

                    window.scrollTo(0, 0);
                    }
                });
                });

                document.querySelectorAll(".styles > li").forEach((style) => {
                style.addEventListener("click", (event) => {
                    const current = document.querySelector(".styles .current");
                    const currentStyle = current.textContent;
                    const nextStyle = event.target.textContent;

                    if (currentStyle !== nextStyle) {
                    document.querySelector(`link[title="${nextStyle}"]`).removeAttribute("disabled");
                    document.querySelector(`link[title="${currentStyle}"]`).setAttribute("disabled", "disabled");

                    current.classList.remove("current");
                    event.target.classList.add("current");
                    }
                });
            });
        </script>
        <?php } ?>
    </body>
</html>
<!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "111517001368654");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v12.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>