<ul>
    <?php 
        $list = unserialize($data); 
        foreach ($list as $k => $v) {
            echo "<li>".ucwords(str_replace('_', ' ', $k))." : ". ucwords($v)."</li>";
        }
    ?>
</ul>