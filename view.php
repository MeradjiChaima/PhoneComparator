<?php
class View
{
    private function show_head()
    {
?>

        <head>
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

            <title>
                Comparateur SmartPhone
            </title>
        <?php
    }

    private function show_title_page()
    {   ?>
            <h1>Comparateur SmartPhone</h1>
        <?php
    }
    private function show_diaporama()
    {   ?>

            <div class="images">
                <img class="img" src="https://www.notebookcheck.biz/fileadmin/Notebooks/News/_nc3/download_1_7.png" alt="ImageSmartphone" />
                <img class="img" src="https://images.unsplash.com/photo-1603791239531-1dda55e194a6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8YXBwbGUlMjBpcGhvbmV8ZW58MHx8MHx8fDA%3D&w=1000&q=80" alt="" />
                <img class="img" src="https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8c2Ftc3VuZyUyMHBob25lfGVufDB8fDB8fHww&w=1000&q=80" alt="" />
                <img class="img" src="https://images.unsplash.com/photo-1595941069915-4ebc5197c14a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8aHVhd2VpJTIwcGhvbmV8ZW58MHx8MHx8fDA%3D&w=1000&q=80" alt="" />

            </div>
            <script>
                const imageContainer = document.querySelector(".images");
                const images = imageContainer.querySelectorAll("img");
                let currentIndex = 0;
                let animationInterval;

                function fadeInNextImage() {
                    images[currentIndex].style.opacity = 0;
                    currentIndex = (currentIndex + 1) % images.length;
                    images[currentIndex].style.opacity = 1;
                }

                animationInterval = setInterval(fadeInNextImage, 2000);

                images.forEach((img) => {
                    img.addEventListener("mouseenter", () => {});

                    img.addEventListener("mouseleave", () => {
                        animationInterval = setInterval(fadeInNextImage, 2000);
                    });
                });

                images.forEach((img, index) => {
                    img.style.opacity = 0;
                    if (index === 0) {
                        img.style.opacity = 1;
                    }
                });
            </script>
        <?php
    }
    private function show_menu()
    {  ?>

            <div class="mymenu">
                <ul id="menu">
                    <li><a>Acceuil</a></li>
                    <li id="marques"><a>Marques</a>
                        <ul class="sub-menu">
                            <li id="marque"><a href="https://www.apple.com/fr/"> Apple </a></li>
                            <li id="marque"><a href="https://www.samsung.com/fr/"> Samsung </a></li>
                            <li id="marque"><a href="https://www.nokia.com/phones/fr_fr"> Nokia </a></li>
                            <li id="marque"><a href="https://consumer.huawei.com/dz/"> Huawei </a></li>
                            <li id="marque"><a href="https://www.mi.com/fr/"> Xiaomi </a></li>
                        </ul>
                    </li>
                    <li><a>News</a></li>
                    <li><a>Contacts</a></li>


                </ul>
            </div>
        <?php
    }
    private function show_table()
    {


        try {
            $c = new Controller();
            $phones = $c->controller_get_table();

            echo '<div class="table">';
            echo '<table id="table_comparaison">';
            echo '<tr>';
            echo '<th scope="col">Features</th>';

            $smartphones = array_unique(array_column($phones, 'Smartphone'));
            foreach ($smartphones as $smartphone) {
                echo "<th scope='col'>$smartphone</th>";
            }
            echo '</tr>';
            $features = array_unique(array_column($phones, 'Feature'));
            foreach ($features as $feature) {
                echo '<tr>';
                echo '<th scope="col">' . $feature . '</th>';
                foreach ($smartphones as $smartphone) {
                    $value = '';
                    foreach ($phones as $phone) {
                        if ($phone['Feature'] === $feature && $phone['Smartphone'] === $smartphone) {
                            $value = $phone['FeatureValue'];
                            break;
                        }
                    }
                    echo '<td>' . $value . '</td>';
                }

                echo '</tr>';
            }

            echo '</table>';
            echo '</div>';
        } catch (Exception $e) {
            echo 'Error getting table: ' . $e->getMessage();
        }
    }




    private function show_footer()

    {
        echo '</br></br>'; ?>
            <div>
                <footer>
                    <div class="contact-info">
                        <h5 class="myp">Contactez nous sur le mail : </h5>
                        <a href="mailto:kc_meradji@esi.dz">kc_meradji@esi.dz</a>
                        <p>Téléphone: (123) 456-7890</p>
                        <p>Address: 123 Oued Smar, Alger, Algerie</p>
                    </div>
                </footer>
            </div>


            <?php
        }
        private function show_body()
        {   ?><?php
                $this->show_title_page();
                $this->show_diaporama();
                $this->show_menu();
                $this->show_table();
                $this->show_footer();
            }


            public function show()
            {
                echo '<!DOCTYPE html>
                <html>';
                $this->show_head();
                $this->show_body();
                echo '</html>';
            }
        }
