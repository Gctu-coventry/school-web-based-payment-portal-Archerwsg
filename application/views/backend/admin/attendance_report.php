<hr />

<?php echo form_open(site_url('admin/attendance_report_selector/')); ?>
<div class="row">

    <?php
    $query = $this->db->get('cell');
    if ($query->num_rows() > 0):
        $cell = $query->result_array();

        ?>

        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('cell'); ?></label>
                <select class="form-control selectboxit" name="cell_id" onchange="select_section(this.value)">
                    <option value=""><?php echo get_phrase('select_cell'); ?></option>
                    <?php foreach ($cell as $row): ?>
                    <option value="<?php echo $row['cell_id']; ?>" ><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    <?php endif; ?>

   
    <div class="col-md-2">
         <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
            <select name="month" class="form-control selectboxit">
                <?php
                for ($i = 1; $i <= 12; $i++):
                    if ($i == 1)
                        $m = 'january';
                    else if ($i == 2)
                        $m = 'february';
                    else if ($i == 3)
                        $m = 'march';
                    else if ($i == 4)
                        $m = 'april';
                    else if ($i == 5)
                        $m = 'may';
                    else if ($i == 6)
                        $m = 'june';
                    else if ($i == 7)
                        $m = 'july';
                    else if ($i == 8)
                        $m = 'august';
                    else if ($i == 9)
                        $m = 'september';
                    else if ($i == 10)
                        $m = 'october';
                    else if ($i == 11)
                        $m = 'november';
                    else if ($i == 12)
                        $m = 'december';
                    ?>
                    <option value="<?php echo $i; ?>"
                          <?php if($month == $i) echo 'selected'; ?>  >
                                <?php echo get_phrase($m); ?>
                    </option>
                    <?php
                endfor;
                ?>
            </select>
         </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('sessional_year'); ?></label>
            <select class="form-control selectboxit" name="sessional_year">
                <?php
                $sessional_year_options = explode('-', $running_year); ?>
                <option value="<?php echo $sessional_year_options[0]; ?>"><?php echo $sessional_year_options[0]; ?></option>
                <option value="<?php echo $sessional_year_options[1]; ?>"><?php echo $sessional_year_options[1]; ?></option>
            </select>
        </div>
    </div>

    <input type="hidden" name="operation" value="selection">
    <input type="hidden" name="year" value="<?php echo $running_year;?>">

	<div class="col-md-2" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info"><?php echo get_phrase('show_report');?></button>
	</div>
</div>

<?php echo form_close(); ?>

<script type="text/javascript">
    function select_section(cell_id) {

        $.ajax({
            url: '<?php echo site_url('admin/get_section/'); ?>' + cell_id,
            success: function (response)
            {

                jQuery('#section_holder').html(response);
            }
        });
    }
</script>
