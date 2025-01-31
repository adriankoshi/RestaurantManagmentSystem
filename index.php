<?php
require_once 'includes/header.php';
require_once 'classes/Tables.php';

$tables = new Tables();
$allFloors = $tables->getFloors();
$getTables = $tables->getTables();
// Group tables by floor_id
$tablesByFloor = [];
foreach ($getTables as $table) {
    $tablesByFloor[$table['table_floor']][] = $table;
}

?>
<section class="tables-content">
    <div class="reservations mr-4">
        <div class="reservations-head">
            <ul>
                <li class="tab active" data-tab="reservations">Reservations <span class="count">4</span></li>
                <li class="tab" data-tab="waitlist">Waitlist</li>
                <li class="tab" data-tab="servers">Servers</li>
            </ul>
            <div class="search-filter m-2">
                <input type="text" placeholder="Search here">
                <button class="filter-btn">
                    <i class="fa fa-magnifying-glass"></i>
                </button>
            </div>
        </div>
        <div class="reservations-body tab-content" id="reservations">
            <h3>Lunch</h3>
            <div class="reservation-item">
                <div class="info">
                    <p class="name">Filan Fisteku</p>
                    <p style="font-size: 0.8rem;"><i class="fa fa-user"></i> 4 Person · <i class="fa fa-table"></i> Tables: 05, 06, 07</p>
                </div>
                <div class="time">10:00 PM</div>
            </div>
            <div class="reservation-item">
                <div class="info">
                    <p class="name">Filan Fisteku</p>
                    <p style="font-size: 0.8rem;"><i class="fa fa-user"></i> 4 Person · <i class="fa fa-table"></i> Tables: 05, 06, 07</p>
                </div>
                <div class="time">10:00 PM</div>
            </div>

            <h3>Dinner</h3>
            <div class="reservation-item">
                <div class="info">
                    <p class="name">Filan Fisteku</p>
                    <p style="font-size: 0.8rem;"><i class="fa fa-user"></i> 4 Person · <i class="fa fa-table"></i> Tables: 05, 06, 07</p>
                </div>
                <div class="time">10:00 PM</div>
            </div>
            <div class="reservation-item">
                <div class="info">
                    <p class="name">Filan Fisteku</p>
                    <p style="font-size: 0.8rem;"><i class="fa fa-user"></i> 4 Person · <i class="fa fa-table"></i> Tables: 05, 06, 07</p>
                </div>
                <div class="time">10:00 PM</div>
            </div>
            <div class="reservation-item">
                <div class="info">
                    <p class="name">Filan Fisteku</p>
                    <p style="font-size: 0.8rem;"><i class="fa fa-user"></i> 4 Person · <i class="fa fa-table"></i> Tables: 05, 06, 07</p>
                </div>
                <div class="time">10:00 PM</div>
            </div>
        </div>
    </div>
    <div class="tables">
        <div class="tables-head">

            <ul>
                <?php
                if (!empty($allFloors)) {
                    foreach ($allFloors as $index => $floor) {
                        $activeClass = ($index == 0) ? 'active' : '';
                ?>
                        <li class="tab <?php echo $activeClass; ?>" data-tab="<?php echo $floor['tf_name']; ?>"><?php echo $floor['tf_name']; ?></li>
                <?php
                    }
                } else {
                    echo "No tables found.";
                }
                ?>
            </ul>
        </div>
        <div class="tables-body">
            <?php
            if (!empty($allFloors)) {
                foreach ($allFloors as $index => $floor) {
                    $activeClass = ($index == 0) ? '' : 'display: none;';
            ?>
                    <div class="tab-content" id="<?php echo $floor['tf_name']; ?>" style="<?php echo $activeClass; ?>">

                        <div class="row-table">
                            <?php
                            // Display tables that belong to the current floor
                            if (isset($tablesByFloor[$floor['tf_id']])) {
                                foreach ($tablesByFloor[$floor['tf_id']] as $table) {
                            ?>
                                    <a class="table-link" href="order.php?id=<?php echo $table['table_id']; ?>&gid=0"><?php echo htmlspecialchars($table['table_name']); ?></a>
                            <?php
                                }
                            } else {
                                echo "No tables found for this floor.";
                            }
                            ?>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "No floors found.";
            }
            ?>
        </div>
    </div>
</section>
</div>

<script>
    document.querySelectorAll(".reservations-head .tab").forEach((tab) => {
        tab.addEventListener("click", function() {
            const parent = this.closest(".reservations");

            parent.querySelectorAll(".tab").forEach((item) => item.classList.remove("active"));

            this.classList.add("active");

            parent.querySelectorAll(".tab-content").forEach((content) => (content.style.display = "none"));

            const targetContent = parent.querySelector(`#${this.getAttribute("data-tab")}`);
            if (targetContent) {
                targetContent.style.display = "block";
            }
        });
    });

    document.querySelectorAll(".tables-head .tab").forEach((tab) => {
        tab.addEventListener("click", function() {
            const parent = this.closest(".tables");

            parent.querySelectorAll(".tab").forEach((item) => item.classList.remove("active"));

            this.classList.add("active");

            parent.querySelectorAll(".tab-content").forEach((content) => (content.style.display = "none"));

            const targetContent = parent.querySelector(`#${this.getAttribute("data-tab")}`);
            if (targetContent) {
                targetContent.style.display = "block";
            }
        });
    });
</script>

<?php
require_once 'includes/footer.php';
?>