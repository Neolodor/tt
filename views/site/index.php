<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;

?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div style="width: 25%; margin: 0 auto;">
            <?php

            foreach ($this->params['authors'] as $author)
            {
                echo "<h4>{$author['first_name']} {$author['last_name']}</h4>";

                $tmp = [];

                foreach ($this->params['books'] as $book)
                {
                    if($book['author_id'] == $author['id']) $tmp[] = $book['name'];
                }

                echo Html::ol($tmp);
            }
            ?>
            </div>
        </div>

    </div>
</div>
