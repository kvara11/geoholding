<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\ModuleStep;
use App\Models\ModuleBlock;
use App\Models\Page;
use App\Models\Bsc;
use App\Models\Bsw;
use App\Models\Language;
use App\ADefaultData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AModuleBlockController extends Controller {
	public function add($moduleId, $stepId) {
		$module = Module :: find($moduleId);
		$moduleStep = ModuleStep :: find($stepId);

		$moduleBlock = new ModuleBlock();

		$moduleBlock -> top_level = $moduleStep -> id;

		$moduleBlock -> save();


		return redirect() -> route('moduleBlockEdit', array($module -> id, $moduleStep -> id, $moduleBlock -> id));
	}


	public function edit($moduleId, $stepId, $id) {
		$module = Module :: find($moduleId);
		$moduleStep = ModuleStep :: find($stepId);
		$moduleBlock = ModuleBlock :: find($id);


		$prevId = 0;
		$nextId = 0;

		$prevIdIsSaved = false;
		$nextIdIsSaved = false;

		foreach(ModuleBlock :: where('top_level', $moduleStep -> id) -> orderBy('rang', 'desc') -> get() as $data) {
			if($nextIdIsSaved && !$nextId) {
				$nextId = $data -> id;
			}
			
			if($moduleBlock -> id === $data -> id) {
				$prevIdIsSaved = true;
				$nextIdIsSaved = true;
			}
			
			if(!$prevIdIsSaved) {
				$prevId = $data -> id;
			}
		}


		$blockTypes = array('alias' => 'alias',
							'input' => 'input',
							'input_with_languages' => 'input_with_languages',
							'editor' => 'editor',
							'editor_with_languages' => 'editor_with_languages',
							'file' => 'file',
							'image' => 'image',
							'select' => 'select',
							'calendar' => 'calendar',
							'color_picker' => 'color_picker',
							'rang' => 'rang',
							'published' => 'published',
							'select_with_optgroup' => 'select_with_optgroup',
							'select_with_ajax' => 'select_with_ajax',
							'checkbox' => 'checkbox',
							'multiply_checkboxes' => 'multiply_checkboxes',
							'multiply_checkboxes_with_category' => 'multiply_checkboxes_with_category',
							'multiply_input_params' => 'multiply_input_params');
		

		$defaultData = ADefaultData :: get();

		$data = array_merge($defaultData, ['pages' => Page :: where('published', 1) -> get(),
											'languages' => Language :: where('published', 1) -> get(),
											'module' => $module,
											'moduleSteps' => ModuleStep :: where('top_level', $module -> id) -> get(),
											'moduleBlocks' => ModuleBlock :: where('top_level', $moduleStep -> id) -> get(),
											'moduleStep' => $moduleStep,
											'moduleBlock' => $moduleBlock,
											'blockTypes' => $blockTypes,
											'prev' => $prevId,
											'next' => $nextId]);

		return view('modules.modules.admin_panel.edit_step_2', $data);
	}


	public function update(Request $request, $moduleId, $stepId, $id) {
		$module = Module :: find($moduleId);
		$moduleStep = ModuleStep :: find($stepId);
		$moduleBlock = ModuleBlock :: find($id);


		// Validation
			// $validator = Validator :: make($request -> all(), array(
			// 	'db_column' => 'required|min:2|max:100'
			// ));

			// if($validator -> fails()) {
			// 	return redirect() -> route('moduleBlockEdit', array($module -> id, $moduleStep -> id, $moduleBlock -> id)) -> withErrors($validator) -> withInput();
			// }
		//


		$moduleBlock -> type = $request -> input('type');
		$moduleBlock -> db_column = $request -> input('db_column');
		$moduleBlock -> label = $request -> input('label');
		$moduleBlock -> example = $request -> input('example');

		if($request -> input('check_in_delete_empty')) {
			$moduleBlock -> check_in_delete_empty = $request -> input('check_in_delete_empty');
		} else {
			$moduleBlock -> check_in_delete_empty = 0;
		}

		if($request -> input('a_use_for_sort')) {
			$moduleBlock -> a_use_for_sort = $request -> input('a_use_for_sort');
		} else {
			$moduleBlock -> a_use_for_sort = 0;
		}

		if($request -> input('sort_by_desc')) {
			$moduleBlock -> sort_by_desc = $request -> input('sort_by_desc');
		} else {
			$moduleBlock -> sort_by_desc = 0;
		}

		if($request -> input('a_use_for_tags')) {
			$moduleBlock -> a_use_for_tags = $request -> input('a_use_for_tags');
		} else {
			$moduleBlock -> a_use_for_tags = 0;
		}

		if($request -> input('file_possibility_to_delete')) {
			$moduleBlock -> file_possibility_to_delete = $request -> input('file_possibility_to_delete');
		} else {
			$moduleBlock -> file_possibility_to_delete = 0;
		}
		
		$moduleBlock -> image_width = $request -> input('image_width');
		$moduleBlock -> image_height = $request -> input('image_height');
		$moduleBlock -> fit_position = $request -> input('fit_position');

		if($request -> input('fit_type')) {
			$moduleBlock -> fit_type = $request -> input('fit_type');
		} 

		$moduleBlock -> image_width_1 = $request -> input('image_width_1');
		$moduleBlock -> image_height_1 = $request -> input('image_height_1');

		if($request -> input('fit_type_1')) {
			$moduleBlock -> fit_type_1 = $request -> input('fit_type_1');
		}

		$moduleBlock -> image_width_2 = $request -> input('image_width_2');
		$moduleBlock -> image_height_2 = $request -> input('image_height_2');

		if($request -> input('fit_type_2')) {
			$moduleBlock -> fit_type_2 = $request -> input('fit_type_2');
		}

		if($request -> input('fit_type_3')) {
			$moduleBlock -> fit_type_3 = $request -> input('fit_type_3');
		}

		//image prefix in the name (exp: prefix_3.jpg)
			$moduleBlock -> prefix = $request -> input('prefix');
		//

		//aditional images with prefixes (exp: 3_prefix_1.jpg)
			$moduleBlock -> prefix_1 = $request -> input('prefix_1');
			$moduleBlock -> prefix_2 = $request -> input('prefix_2');
			$moduleBlock -> prefix_3 = $request -> input('prefix_3');
		//

		if($request -> input('hide')) {
			$moduleBlock -> hide = $request -> input('hide');
		} else {
			$moduleBlock -> hide = 0;
		}

		$moduleBlock -> min_range = $request -> input('min_range');
		$moduleBlock -> max_range = $request -> input('max_range');
		$moduleBlock -> range_step = $request -> input('range_step');
		$moduleBlock -> range_value = $request -> input('range_value');

		$moduleBlock -> select_table = $request -> input('select_table');
		$moduleBlock -> select_condition = $request -> input('select_condition');
		$moduleBlock -> select_sort_by = $request -> input('select_sort_by');
		$moduleBlock -> select_search_column = $request -> input('select_search_column');
		$moduleBlock -> select_option_text = $request -> input('select_option_text');
		$moduleBlock -> select_sort_by_text = $request -> input('select_sort_by_text');
		$moduleBlock -> select_optgroup_table = $request -> input('select_optgroup_table');
		$moduleBlock -> select_optgroup_sort_by = $request -> input('select_optgroup_sort_by');
		$moduleBlock -> select_optgroup_text = $request -> input('select_optgroup_text');
		$moduleBlock -> select_option_2_text = $request -> input('select_option_2_text');
		$moduleBlock -> select_optgroup_2_table = $request -> input('select_optgroup_2_table');
		$moduleBlock -> select_optgroup_2_sort_by = $request -> input('select_optgroup_2_sort_by');
		$moduleBlock -> select_optgroup_2_text = $request -> input('select_optgroup_2_text');
		$moduleBlock -> select_active_option = $request -> input('select_active_option');
		$moduleBlock -> select_first_option_value = $request -> input('select_first_option_value');
		$moduleBlock -> select_first_option_text = $request -> input('select_first_option_text');
		$moduleBlock -> label_for_ajax_select = $request -> input('label_for_ajax_select');
		// $moduleBlock -> file_folder = $request -> input('file_folder');
		// $moduleBlock -> file_title = $request -> input('file_title');
		$moduleBlock -> file_format = $request -> input('file_format');
		// $moduleBlock -> file_name_index_1 = $request -> input('file_name_index_1');
		// $moduleBlock -> file_name_index_2 = $request -> input('file_name_index_2');
		// $moduleBlock -> file_name_index_3 = $request -> input('file_name_index_3');
		$moduleBlock -> radio_value = $request -> input('radio_value');
		$moduleBlock -> radio_class = $request -> input('radio_class');
		$moduleBlock -> sql_select_with_checkboxes_table = $request -> input('sql_select_with_checkboxes_table');
		$moduleBlock -> sql_select_with_checkboxes_sort_by = $request -> input('sql_select_with_checkboxes_sort_by');
		$moduleBlock -> sql_select_with_checkboxes_option_text = $request -> input('sql_select_with_checkboxes_option_text');
		$moduleBlock -> sql_select_with_checkboxes_table_inside = $request -> input('sql_select_with_checkboxes_table_inside');
		$moduleBlock -> sql_select_with_checkboxes_sort_by_inside = $request -> input('sql_select_with_checkboxes_sort_by_inside');
		$moduleBlock -> sql_select_with_checkboxes_option_text_inside = $request -> input('sql_select_with_checkboxes_option_text_inside');
		$moduleBlock -> params_values_table = $request -> input('params_values_table');
		$moduleBlock -> div_id = $request -> input('div_id');
		$moduleBlock -> validation = $request -> input('validation');


		$moduleBlock -> save();

		return redirect() -> route('moduleBlockEdit', array($module -> id, $moduleStep -> id, $moduleBlock -> id));
	}
	

	public function delete($moduleId, $stepId, $id) {
		ModuleBlock :: destroy($id);

		return redirect() -> route('moduleStepEdit', array($moduleId, $stepId));
	}
}