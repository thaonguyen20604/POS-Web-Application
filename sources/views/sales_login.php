<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/admin_login.css">
    <link rel="icon" type="image/x-icon" href="../images/icon.ico">
</head>
<body>
    <main>
    <div class="container">
        <div class="logo">
            <svg 
                xmlns:dc="http://purl.org/dc/elements/1.1/"
                xmlns:cc="http://creativecommons.org/ns#"
                xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                xmlns:svg="http://www.w3.org/2000/svg"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                width="30"
                height="30"
                viewBox="0 0 30 30"
                version="1.1"
                id="svg822"
                inkscape:version="0.92.4 (f8dce91, 2019-08-02)"
                sodipodi:docname="people.svg">
                <defs
                    id="defs816" />
                <sodipodi:namedview
                    id="base"
                    pagecolor="#ffffff"
                    bordercolor="#666666"
                    borderopacity="1.0"
                    inkscape:pageopacity="0.0"
                    inkscape:pageshadow="2"
                    inkscape:zoom="12.610071"
                    inkscape:cx="18.02637"
                    inkscape:cy="5.0061764"
                    inkscape:document-units="px"
                    inkscape:current-layer="layer1"
                    showgrid="true"
                    units="px"
                    inkscape:window-width="1366"
                    inkscape:window-height="713"
                    inkscape:window-x="0"
                    inkscape:window-y="0"
                    inkscape:window-maximized="1"
                    showguides="true"
                    inkscape:snap-global="false">
                    <inkscape:grid
                    type="xygrid"
                    id="grid816" />
                </sodipodi:namedview>
                <metadata
                    id="metadata819">
                    <rdf:RDF>
                    <cc:Work
                        rdf:about="">
                        <dc:format>image/svg+xml</dc:format>
                        <dc:type
                        rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                        <dc:title>

                </dc:title>
                    </cc:Work>
                    </rdf:RDF>
                </metadata>
                <g
                    inkscape:label="Layer 1"
                    inkscape:groupmode="layer"
                    id="layer1"
                    transform="translate(0,-289.0625)">
                    <path
                    style="opacity:0.91000001;fill:#6b7682;fill-opacity:1;stroke:none;stroke-width:0.49999997;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                    d="m 18.853516,8.5820312 c -1.152452,0.0017 -2.230942,0.5679424 -2.886719,1.5156248 0.245759,0.621718 0.386719,1.293985 0.386719,1.998047 0,0.693735 -0.175104,1.331591 -0.4375,1.929688 0.648969,0.990797 1.753084,1.58837 2.9375,1.589843 1.942893,4.49e-4 3.518031,-1.574688 3.517578,-3.517578 -6.26e-4,-1.942127 -1.575448,-3.516074 -3.517578,-3.5156248 z M 22,16.345703 19.912109,19.611328 c 0.528723,1.153814 0.838621,2.416765 0.875,3.738281 l 0.02148,0.783203 -0.515625,0.587891 C 19.548375,25.571315 18.67911,26.30872 17.728516,26.933594 18.114724,26.97681 18.506361,27 18.904297,27 22.05905,27 24.881454,25.60556 26.806641,23.40625 26.721561,20.31573 24.843996,17.558273 22,16.345703 Z"
                    transform="translate(0,289.0625)"
                    id="path1013"
                    inkscape:connector-curvature="0"
                    sodipodi:nodetypes="ccsccccccccccscc" />
                    <path
                    inkscape:connector-curvature="0"
                    id="path1018"
                    d="m 10.835941,297.64216 a 3.5167647,3.516759 0 0 0 -3.5167638,3.51676 3.5167647,3.516759 0 0 0 3.5167638,3.51676 3.5167647,3.516759 0 0 0 3.516765,-3.51676 3.5167647,3.516759 0 0 0 -3.516765,-3.51676 z m 3.145856,7.76332 -3.0703,4.80292 -3.1115121,-4.79948 c -2.8464838,1.20791 -4.7285466,3.96325 -4.8183795,7.05412 1.925237,2.20091 4.7480521,3.59746 7.9041346,3.59746 3.154753,0 5.97723,-1.39473 7.902417,-3.59403 -0.08508,-3.09053 -1.962364,-5.84843 -4.80636,-7.06099 z"
                    style="opacity:0.91000001;fill:#6b7682;fill-opacity:1;stroke:#ff0000;stroke-width:0.004;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
                </g>
            </svg>
        </div>
        <section class="login">
            <form action="../staffs/sales_auth.php" method="post" class="clearfix">        
                <h2>STAFFS LOGIN</h2>    
                <!-- <label for="username">User Name</label><br> -->
                <input type="text" id="username" name="username" placeholder="Username">
                <!-- <label for="password">Password</label><br> -->
                <input type="password" id="password" name="password" placeholder="Password"><br>
                <div>
                    <?php
                        if (isset($_GET['error'])) {
                            $error = $_GET['error'];
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                    ?>
                    <button id="butt" type="submit">Login</button><br>
                </div>
                <!-- <p><a href="../staffs/change_pass.php">Forgot your password?</a></p> -->
                <br>
            </form>
        </section>
    </main>
    <footer class="footer">
        <span>Copyright</span>
        <svg viewBox="0 0 24 24" id="meteor-icon-kit__regular-copyright" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.6707 5.96795C8.36196 6.14922 5.82664 8.97844 6.00791 12.2872C6.18919 15.5959 9.01841 18.1313 12.3272 17.95C13.8706 17.8654 15.3173 17.1712 16.3489 16.02L16.4299 15.9296C16.7985 15.5183 16.7638 14.8861 16.3525 14.5175C15.9412 14.149 15.309 14.1836 14.9404 14.5949L14.8595 14.6852C14.1818 15.4414 13.2316 15.8974 12.2177 15.953C10.0119 16.0738 8.12577 14.3836 8.00492 12.1778C7.88407 9.97195 9.57428 8.0858 11.7801 7.96495C12.794 7.90941 13.7883 8.25889 14.5445 8.93651L14.6349 9.01747C15.0462 9.38605 15.6784 9.35141 16.047 8.94011C16.4155 8.5288 16.3809 7.89659 15.9696 7.52801L15.8792 7.44705C14.728 6.41543 13.2142 5.88339 11.6707 5.96795Z" fill="#758CA3"/><path fill-rule="evenodd" clip-rule="evenodd" d="M24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12ZM22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" fill="#758CA3"/></svg>
        <span>2024. All Rights Reserved.</span>
    </footer>
</body>
</html>
