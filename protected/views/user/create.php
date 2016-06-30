<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List User','url'=>array('index')),
array('label'=>'Manage User','url'=>array('admin')),
);
?>

<div class="row">
     <!-- page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Registration Form</h1>
    </div>
    <!--end page header -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
				<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</div>