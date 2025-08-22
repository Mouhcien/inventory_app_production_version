$(function(){
    $("#btn_type_material").on('click', function(){
        const value = $("#type_material_id").val();
        window.location.href = '/materials/filter/type/'+value;
    });

    $("#btn_brand_material").on('click', function(){
        const value = $("#brand_material_id").val();
        window.location.href = '/materials/filter/brand/'+value;
    });

    $("#btn_model_material").on('click', function(){
        const value = $("#model_material_id").val();
        window.location.href = '/materials/filter/model/'+value;
    });

    $("#btn_march_material").on('click', function(){
        const value = $("#march_material_id").val();
        window.location.href = '/materials/filter/march/'+value;
    });

    /*** +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */

    $("#adv_type_material_id").on('change', function(){
        let brand_id = $("#adv_brand_material_id").val();
        let model_id = $("#adv_model_material_id").val();
        let march_id = $("#adv_march_material_id").val();
        let url = '/materials/filter/advance/?';

        let type_id = $("#adv_type_material_id").val();
        url += 'type='+type_id;

        if (brand_id != 0)
            url += '&brand='+brand_id;

        if (model_id != 0)
            url += '&model='+model_id;

        if (march_id != 0)
            url += '&march='+march_id;

        let state = $("#adv_state_material_id").val();
        if (state != 0)
            url += '&state='+state;

        window.location.href = url;
    });

    $("#adv_brand_material_id").on('change', function(){
        let type_id = $("#adv_type_material_id").val();
        let model_id = $("#adv_model_material_id").val();
        let march_id = $("#adv_march_material_id").val();
        let url = '/materials/filter/advance/?';

        let brand_id = $("#adv_brand_material_id").val();
        url += 'brand='+brand_id;

        if (type_id != 0)
            url += '&type='+type_id;

        if (model_id != 0)
            url += '&model='+model_id;

        if (march_id != 0)
            url += '&march='+march_id;

        let state = $("#adv_state_material_id").val();
        if (state != 0)
            url += '&state='+state;

        window.location.href = url;
    });

    $("#adv_model_material_id").on('change', function(){
        let type_id = $("#adv_type_material_id").val();
        let brand_id = $("#adv_brand_material_id").val();
        let march_id = $("#adv_march_material_id").val();
        let url = '/materials/filter/advance/?';

        let model_id = $("#adv_model_material_id").val();
        url += 'model='+model_id;

        if (type_id != 0)
            url += '&type='+type_id;

        if (brand_id != 0)
            url += '&brand='+brand_id;

        if (march_id != 0)
            url += '&march='+march_id;

        let state = $("#adv_state_material_id").val();
        if (state != 0)
            url += '&state='+state;

        window.location.href = url;
    });

    $("#adv_march_material_id").on('change', function(){
        let type_id = $("#adv_type_material_id").val();
        let brand_id = $("#adv_brand_material_id").val();
        let model_id = $("#adv_model_material_id").val();
        let url = '/materials/filter/advance/?';

        let march_id = $("#adv_march_material_id").val();
        url += 'march='+march_id;

        if (type_id != 0)
            url += '&type='+type_id;

        if (brand_id != 0)
            url += '&brand='+brand_id;

        if (model_id != 0)
            url += '&model='+model_id;

        let state = $("#adv_state_material_id").val();
        if (state != 0)
            url += '&state='+state;

        window.location.href = url;

    });

    $("#adv_state_material_id").on('change', function(){
        let state = $("#adv_state_material_id").val();
        let url = '/materials/filter/advance/?state='+state;
        if (state == "3")
            url = '/materials/filter/advance/?fr='+state;


        let type_id = $("#adv_type_material_id").val();
        let brand_id = $("#adv_brand_material_id").val();
        let model_id = $("#adv_model_material_id").val();
        let march_id = $("#adv_march_material_id").val();

        if (march_id != 0)
            url += '&march='+march_id;

        if (type_id != 0)
            url += '&type='+type_id;

        if (brand_id != 0)
            url += '&brand='+brand_id;

        if (model_id != 0)
            url += '&model='+model_id;

        window.location.href = url;

    });


    /** ********************************************************** **/
    $("#sl_service_entity_id").on('change', function(){

        let service_id = $("#sl_service_entity_id").val();
        let url = '/employees/create/?srv='+service_id;
        window.location.href = url;

    });


    $("#sl_entity_id").on('change', function(){

        let entity_id = $("#sl_entity_id").val();
        let service_id = $("#sl_service_entity_id").val();
        let url = '/employees/create/?srv='+service_id+'&ent='+entity_id;
        window.location.href = url;

    });

    /** ********************************************************** **/
    $("#sl_local_id_import").on('change', function(){

        let local_id = $("#sl_local_id_import").val();
        let url = '/employees/prepare/?loc='+local_id;
        window.location.href = url;

    });

    $("#sl_service_entity_id_import").on('change', function(){

        let service_id = $("#sl_service_entity_id_import").val();
        let local_id = $("#sl_local_id_import").val();
        let url = '/employees/prepare/?srv='+service_id+'&loc='+local_id;
        window.location.href = url;

    });


    $("#sl_entity_id_import").on('change', function(){

        let entity_id = $("#sl_entity_id_import").val();
        let service_id = $("#sl_service_entity_id_import").val();
        let local_id = $("#sl_local_id_import").val();
        let url = '/employees/prepare/?srv='+service_id+'&ent='+entity_id+'&loc='+local_id;
        window.location.href = url;

    });

    /** ********************************************************** **/
    $("#sl_employee_id").on('change', function(){

        let employee_id = $("#sl_employee_id").val();
        let url = '/furnitures/consummations/create?emp='+employee_id;
        let type_consumable_id = $("#sl_type_consumable_id").val();
        if (type_consumable_id != 0) {
            url += '&tpc='+type_consumable_id
        }
        window.location.href = url;

    });

    $("#sl_type_consumable_id").on('change', function(){

        let type_consumable_id = $("#sl_type_consumable_id").val();
        let url = '/furnitures/consummations/create?tpc='+type_consumable_id;
        let employee_id = $("#sl_employee_id").val();
        if (employee_id != 0) {
            url += '&emp='+employee_id
        }
        window.location.href = url;

    });

    $("input[name='consumable_id']").change(function() {
        let consumable_id = $(this).val();
        let url = '/furnitures/consummations/create?cns='+consumable_id;

        let employee_id = $("#sl_employee_id").val();
        if (employee_id != 0) {
            url += '&emp='+employee_id
        }
        let type_consumable_id = $("#sl_type_consumable_id").val();
        if (type_consumable_id != 0) {
            url += '&tpc='+type_consumable_id
        }
        window.location.href = url;
    });

    $("#sl_btn_employee").on('click', function(){
        let employee_id = $("#sl_employee_id").val();
        $("#hd_employee_id").val(employee_id);
        $(this).hide();
    });

    $("button[name='btn_stock_id']").on('click', function(){
        let stock_id = $(this).val();
        $("#hd_stock_id").val(stock_id);
        $(this).hide();
    });


    /** ***************************************************************** */
    $("#btn_inv_type_material").on('click', function(){
        const value = $("#inv_type_material_id").val();
        window.location.href = '/inventories/filter/type/'+value;
    });

    $("#btn_inv_brand_material").on('click', function(){
        const value = $("#inv_brand_material_id").val();
        window.location.href = '/inventories/filter/brand/'+value;
    });

    $("#btn_inv_model_material").on('click', function(){
        const value = $("#inv_model_material_id").val();
        window.location.href = '/inventories/filter/model/'+value;
    });

    $("#btn_inv_march_material").on('click', function(){
        const value = $("#inv_march_material_id").val();
        window.location.href = '/inventories/filter/march/'+value;
    });

    /** ******************************************************************* */
    $("#emp_rech_situation").on('change', function(){
        const value = $("#emp_rech_situation").val();
        window.location.href = '/employees/search/?sit='+value;
    });

    $("#emp_rech_local_id").on('change', function(){
        const value = $("#emp_rech_local_id").val();
        window.location.href = '/employees/search/?loc='+value;
    });

    $("#emp_rech_sl_service_entity_id").on('change', function(){
        const value = $("#emp_rech_sl_service_entity_id").val();
        window.location.href = '/employees/search/?srv='+value;
    });

    $("#emp_rech_sl_entity_id").on('change', function(){
        const value = $("#emp_rech_sl_entity_id").val();

        let url = '/employees/search/?ent='+value;

        let srv = $("#emp_rech_sl_service_entity_id").val();
        if (srv != "0")
            url += "&srv="+srv;

        window.location.href = url

    });

    $("#emp_rech_secter_entity_id").on('change', function(){
        const value = $("#emp_rech_secter_entity_id").val();

        let url = '/employees/search/?sectr='+value;

        let ent = $("#emp_rech_sl_entity_id").val();
        if (ent != "0")
            url += "&ent="+ent;

        let srv = $("#emp_rech_sl_service_entity_id").val();
        if (srv != "0")
            url += "&srv="+srv;

        window.location.href = url

    });

    $("#emp_rech_section_entity_id").on('change', function(){
        const value = $("#emp_rech_section_entity_id").val();

        let url = '/employees/search/?sect='+value;

        let ent = $("#emp_rech_sl_entity_id").val();
        if (ent != "0")
            url += "&ent="+ent;

        let srv = $("#emp_rech_sl_service_entity_id").val();
        if (srv != "0")
            url += "&srv="+srv;

        window.location.href = url

    });

    $("#sl_stat_delivery_year").on('change', function() {
        const year = $("#sl_stat_delivery_year").val();

        window.location.href = '/inventories/statistics/furniture/'+year;
    });

    /** ********************************************* */
    $("#inv_adv_type_material_id").on('change', function(){
        let brand_id = $("#inv_adv_brand_material_id").val();
        let model_id = $("#inv_adv_model_material_id").val();
        let march_id = $("#inv_adv_march_material_id").val();
        let url = '/inventories/advance/?';
        let type_id = $("#inv_adv_type_material_id").val();
        url += 'type='+type_id;

        let fltr = $("#inv_adv_filtr_employee").val();
        if (fltr != "")
            url +="&fltr="+fltr;

        let srl = $("#inv_adv_search_serial").val();
        if (srl != "")
            url += '&srl='+srl;



        if (brand_id != 0)
            url += '&brand='+brand_id;

        if (model_id != 0)
            url += '&model='+model_id;

        if (march_id != 0)
            url += '&march='+march_id;

        let srv = $("#inv_emp_rech_sl_service_entity_id").val();
        if (srv != "0")
            url += "&srv="+srv;

        let ent = $("#inv_emp_rech_sl_entity_id").val();
        if (ent != "0")
            url += "&ent="+ent;

        let sectr = $("#inv_emp_rech_secter_entity_id").val();
        if (sectr != "0")
            url += "&sectr="+sectr;

        let sect = $("#inv_emp_rech_section_entity_id").val();
        if (sect != "0")
            url += "&sect="+sect;

        let loc = $("#inv_emp_rech_local_id").val();
        if (loc != "0")
            url += "&loc="+loc;

        window.location.href = url;
    });

    $("#inv_adv_brand_material_id").on('change', function(){
        let type_id = $("#inv_adv_type_material_id").val();
        let model_id = $("#inv_adv_model_material_id").val();
        let march_id = $("#inv_adv_march_material_id").val();
        let url = '/inventories/advance/?';

        let brand_id = $("#inv_adv_brand_material_id").val();
        url += 'brand='+brand_id;

        let fltr = $("#inv_adv_filtr_employee").val();
        if (fltr != "")
            url +="&fltr="+fltr;

        let srl = $("#inv_adv_search_serial").val();
        if (srl != "")
            url += '&srl='+srl;

        if (type_id != 0)
            url += '&type='+type_id;

        if (model_id != 0)
            url += '&model='+model_id;

        if (march_id != 0)
            url += '&march='+march_id;

        let srv = $("#inv_emp_rech_sl_service_entity_id").val();
        if (srv != "0")
            url += "&srv="+srv;

        let ent = $("#inv_emp_rech_sl_entity_id").val();
        if (ent != "0")
            url += "&ent="+ent;

        let sectr = $("#inv_emp_rech_secter_entity_id").val();
        if (sectr != "0")
            url += "&sectr="+sectr;

        let sect = $("#inv_emp_rech_section_entity_id").val();
        if (sect != "0")
            url += "&sect="+sect;

        let loc = $("#inv_emp_rech_local_id").val();
        if (loc != "0")
            url += "&loc="+loc;

        let state = $("#inv_adv_state_material_id").val();
        if (state != "0")
            url += "&state="+state;

        window.location.href = url;
    });

    $("#inv_adv_model_material_id").on('change', function(){
        let type_id = $("#inv_adv_type_material_id").val();
        let brand_id = $("#inv_adv_brand_material_id").val();
        let march_id = $("#inv_adv_march_material_id").val();
        let url = '/inventories/advance/?';
        let model_id = $("#inv_adv_model_material_id").val();
        url += 'model='+model_id;

        let fltr = $("#inv_adv_filtr_employee").val();
        if (fltr != "")
            url +="&fltr="+fltr;

        if (type_id != 0)
            url += '&type='+type_id;

        if (brand_id != 0)
            url += '&brand='+brand_id;

        if (march_id != 0)
            url += '&march='+march_id;

        let srl = $("#inv_adv_search_serial").val();
        if (srl != "")
            url += '&srl='+srl;

        let srv = $("#inv_emp_rech_sl_service_entity_id").val();
        if (srv != "0")
            url += "&srv="+srv;

        let ent = $("#inv_emp_rech_sl_entity_id").val();
        if (ent != "0")
            url += "&ent="+ent;

        let sectr = $("#inv_emp_rech_secter_entity_id").val();
        if (sectr != "0")
            url += "&sectr="+sectr;

        let sect = $("#inv_emp_rech_section_entity_id").val();
        if (sect != "0")
            url += "&sect="+sect;

        let loc = $("#inv_emp_rech_local_id").val();
        if (loc != "0")
            url += "&loc="+loc;

        let state = $("#inv_adv_state_material_id").val();
        if (state != "0")
            url += "&state="+state;

        window.location.href = url;
    });

    $("#inv_adv_march_material_id").on('change', function(){
        let type_id = $("#inv_adv_type_material_id").val();
        let brand_id = $("#inv_adv_brand_material_id").val();
        let model_id = $("#inv_adv_model_material_id").val();
        let url = '/inventories/advance/?';

        let march_id = $(this).val();
        url += 'march='+march_id;


        let fltr = $("#inv_adv_filtr_employee").val();
        if (fltr != "")
            url +="&fltr="+fltr;

        if (type_id != 0)
            url += '&type='+type_id;

        if (brand_id != 0)
            url += '&brand='+brand_id;

        if (model_id != 0)
            url += '&model='+model_id;

        let srl = $("#inv_adv_search_serial").val();
        if (srl != "")
            url += '&srl='+srl;

        let srv = $("#inv_emp_rech_sl_service_entity_id").val();
        if (srv != "0")
            url += "&srv="+srv;

        let ent = $("#inv_emp_rech_sl_entity_id").val();
        if (ent != "0")
            url += "&ent="+ent;

        let sectr = $("#inv_emp_rech_secter_entity_id").val();
        if (sectr != "0")
            url += "&sectr="+sectr;

        let sect = $("#inv_emp_rech_section_entity_id").val();
        if (sect != "0")
            url += "&sect="+sect;

        let loc = $("#inv_emp_rech_local_id").val();
        if (loc != "0")
            url += "&loc="+loc;

        let state = $("#inv_adv_state_material_id").val();
        if (state != "0")
            url += "&state="+state;

        window.location.href = url;

    });

    $("#inv_emp_rech_local_id").on('change', function(){
        const value = $("#inv_emp_rech_local_id").val();
        let url = '/inventories/advance/?loc='+value;

        let fltr = $("#inv_adv_filtr_employee").val();
        if (fltr != "")
            url +="&fltr="+fltr;

        let type_id = $("#inv_adv_type_material_id").val();
        let brand_id = $("#inv_adv_brand_material_id").val();
        let model_id = $("#inv_adv_model_material_id").val();
        let march_id = $("#inv_adv_march_material_id").val();
        if (march_id != 0)
            url += '&march='+march_id;

        if (type_id != 0)
            url += '&type='+type_id;

        if (brand_id != 0)
            url += '&brand='+brand_id;

        if (model_id != 0)
            url += '&model='+model_id;

        let srl = $("#inv_adv_search_serial").val();
        if (srl != "")
            url += '&srl='+srl;

        let state = $("#inv_adv_state_material_id").val();
        if (state != "0")
            url += "&state="+state;


        let ent = $("#inv_emp_rech_sl_entity_id").val();
        if (ent != "0")
            url += "&ent="+ent;

        let srv = $("#inv_emp_rech_sl_service_entity_id").val();
        if (srv != "0")
            url += "&srv="+srv;

        window.location.href = url;


    });

    $("#inv_emp_rech_sl_service_entity_id").on('change', function(){
        const value = $("#inv_emp_rech_sl_service_entity_id").val();

        let url = '/inventories/advance/?srv='+value;

        let fltr = $("#inv_adv_filtr_employee").val();
        if (fltr != "")
            url +="&fltr="+fltr;

        let state = $("#inv_adv_state_material_id").val();
        if (state != "0")
            url += "&state="+state;

        let type_id = $("#inv_adv_type_material_id").val();
        let brand_id = $("#inv_adv_brand_material_id").val();
        let model_id = $("#inv_adv_model_material_id").val();
        let march_id = $("#inv_adv_march_material_id").val();
        let loc = $("#inv_emp_rech_local_id").val();

        if (march_id != 0)
            url += '&march='+march_id;

        if (type_id != 0)
            url += '&type='+type_id;

        if (brand_id != 0)
            url += '&brand='+brand_id;

        if (model_id != 0)
            url += '&model='+model_id;

        if (loc != "0")
            url += "&loc="+loc;

        window.location.href = url;
    });

    $("#inv_emp_rech_sl_entity_id").on('change', function(){
        const value = $("#inv_emp_rech_sl_entity_id").val();

        let url = '/inventories/advance/?ent='+value;

        let fltr = $("#inv_adv_filtr_employee").val();
        if (fltr != "")
            url +="&fltr="+fltr;

        let srv = $("#inv_emp_rech_sl_service_entity_id").val();
        if (srv != "0")
            url += "&srv="+srv;

        let srl = $("#inv_adv_search_serial").val();
        if (srl != "")
            url += '&srl='+srl;

        let type_id = $("#inv_adv_type_material_id").val();
        let brand_id = $("#inv_adv_brand_material_id").val();
        let model_id = $("#inv_adv_model_material_id").val();
        let march_id = $("#inv_adv_march_material_id").val();
        if (march_id != 0)
            url += '&march='+march_id;

        if (type_id != 0)
            url += '&type='+type_id;

        if (brand_id != 0)
            url += '&brand='+brand_id;

        if (model_id != 0)
            url += '&model='+model_id;

        let loc = $("#inv_emp_rech_local_id").val();
        if (loc != "0")
            url += "&loc="+loc;

        window.location.href = url

    });

    $("#inv_emp_rech_secter_entity_id").on('change', function(){
        const value = $("#inv_emp_rech_secter_entity_id").val();

        let url = '/inventories/advance/?sectr='+value;

        let state = $("#inv_adv_state_material_id").val();
        if (state != "0")
            url += "&state="+state;

        let fltr = $("#inv_adv_filtr_employee").val();
        if (fltr != "")
            url +="&fltr="+fltr;

        let ent = $("#inv_emp_rech_sl_entity_id").val();
        if (ent != "0")
            url += "&ent="+ent;

        let srv = $("#inv_emp_rech_sl_service_entity_id").val();
        if (srv != "0")
            url += "&srv="+srv;

        let srl = $("#inv_adv_search_serial").val();
        if (srl != "")
            url += '&srl='+srl;

        let type_id = $("#inv_adv_type_material_id").val();
        let brand_id = $("#inv_adv_brand_material_id").val();
        let model_id = $("#inv_adv_model_material_id").val();
        let march_id = $("#inv_adv_march_material_id").val();

        if (march_id != 0)
            url += '&march='+march_id;

        if (type_id != 0)
            url += '&type='+type_id;

        if (brand_id != 0)
            url += '&brand='+brand_id;

        if (model_id != 0)
            url += '&model='+model_id;

        let loc = $("#inv_emp_rech_local_id").val();
        if (loc != "0")
            url += "&loc="+loc;

        window.location.href = url

    });

    $("#inv_emp_rech_section_entity_id").on('change', function(){
        const value = $("#inv_emp_rech_section_entity_id").val();

        let url = '/inventories/advance/?sect='+value;

        let state = $("#inv_adv_state_material_id").val();
        if (state != "0")
            url += "&state="+state;

        let fltr = $("#inv_adv_filtr_employee").val();
        if (fltr != "")
            url +="&fltr="+fltr;

        let ent = $("#inv_emp_rech_sl_entity_id").val();
        if (ent != "0")
            url += "&ent="+ent;

        let srv = $("#inv_emp_rech_sl_service_entity_id").val();
        if (srv != "0")
            url += "&srv="+srv;

        let srl = $("#inv_adv_search_serial").val();
        if (srl != "")
            url += '&srl='+srl;

        let type_id = $("#inv_adv_type_material_id").val();
        let brand_id = $("#inv_adv_brand_material_id").val();
        let model_id = $("#inv_adv_model_material_id").val();
        let march_id = $("#inv_adv_march_material_id").val();

        if (march_id != 0)
            url += '&march='+march_id;

        if (type_id != 0)
            url += '&type='+type_id;

        if (brand_id != 0)
            url += '&brand='+brand_id;

        if (model_id != 0)
            url += '&model='+model_id;

        let loc = $("#inv_emp_rech_local_id").val();
        if (loc != "0")
            url += "&loc="+loc;

        window.location.href = url

    });

    $("#btn_inv_adv_search").on('click', function(){
        const value = $("#inv_adv_search_serial").val();

        let url = '/inventories/advance/?srl='+value;

        let type_id = $("#inv_adv_type_material_id").val();
        let brand_id = $("#inv_adv_brand_material_id").val();
        let model_id = $("#inv_adv_model_material_id").val();
        let march_id = $("#inv_adv_march_material_id").val();
        let loc = $("#inv_emp_rech_local_id").val();

        let state = $("#inv_adv_state_material_id").val();
        if (state != "0")
            url += "&state="+state;

        let fltr = $("#inv_adv_filtr_employee").val();
        if (fltr != "")
            url +="&fltr="+fltr;

        if (march_id != 0)
            url += '&march='+march_id;

        if (type_id != 0)
            url += '&type='+type_id;

        if (brand_id != 0)
            url += '&brand='+brand_id;

        if (model_id != 0)
            url += '&model='+model_id;

        if (loc != "0")
            url += "&loc="+loc;

        let srv = $("#inv_emp_rech_sl_service_entity_id").val();
        if (srv != "0")
            url += "&srv="+srv;

        let ent = $("#inv_emp_rech_sl_entity_id").val();
        if (ent != "0")
            url += "&ent="+ent;

        let sectr = $("#inv_emp_rech_secter_entity_id").val();
        if (sectr != "0")
            url += "&sectr="+sectr;

        let sect = $("#inv_emp_rech_section_entity_id").val();
        if (sect != "0")
            url += "&sect="+sect;


        window.location.href = url;
    });

    $("#btn_inv_adv_filtr_employee").on('click', function(){
        const value = $("#inv_adv_filtr_employee").val();

        let url = '/inventories/advance/?fltr='+value;

        let type_id = $("#inv_adv_type_material_id").val();
        let brand_id = $("#inv_adv_brand_material_id").val();
        let model_id = $("#inv_adv_model_material_id").val();
        let march_id = $("#inv_adv_march_material_id").val();
        let loc = $("#inv_emp_rech_local_id").val();
        let srl = $("#inv_adv_search_serial").val();

        if (srl != "")
            url += '&srl='+srl;

        if (march_id != 0)
            url += '&march='+march_id;

        if (type_id != 0)
            url += '&type='+type_id;

        if (brand_id != 0)
            url += '&brand='+brand_id;

        if (model_id != 0)
            url += '&model='+model_id;

        if (loc != "0")
            url += "&loc="+loc;

        let state = $("#inv_adv_state_material_id").val();
        if (state != "0")
            url += "&state="+state;

        let srv = $("#inv_emp_rech_sl_service_entity_id").val();
        if (srv != "0")
            url += "&srv="+srv;

        let ent = $("#inv_emp_rech_sl_entity_id").val();
        if (ent != "0")
            url += "&ent="+ent;

        let sectr = $("#inv_emp_rech_secter_entity_id").val();
        if (sectr != "0")
            url += "&sectr="+sectr;

        let sect = $("#inv_emp_rech_section_entity_id").val();
        if (sect != "0")
            url += "&sect="+sect;


        window.location.href = url;
    });

    $("#inv_adv_state_material_id").on('change', function(){
        const value = $("#inv_adv_state_material_id").val();

        let url = '/inventories/advance/?state='+value;

        let fltr = $("#inv_adv_filtr_employee").val();
        if (fltr != "")
            url +="&fltr="+fltr;

        let ent = $("#inv_emp_rech_sl_entity_id").val();
        if (ent != "0")
            url += "&ent="+ent;

        let srv = $("#inv_emp_rech_sl_service_entity_id").val();
        if (srv != "0")
            url += "&srv="+srv;

        let srl = $("#inv_adv_search_serial").val();
        if (srl != "")
            url += '&srl='+srl;

        let sect = $("#inv_emp_rech_section_entity_id").val();
        if (sect != "0")
            url += "&sect="+sect;

        let sectr = $("#inv_emp_rech_secter_entity_id").val();
        if (sect != "0")
            url += "&sectr="+sectr;

        let type_id = $("#inv_adv_type_material_id").val();
        let brand_id = $("#inv_adv_brand_material_id").val();
        let model_id = $("#inv_adv_model_material_id").val();

        let march_id = $("#inv_adv_march_material_id").val();
        if (march_id != 0)
            url += '&march='+march_id;

        if (type_id != 0)
            url += '&type='+type_id;

        if (brand_id != 0)
            url += '&brand='+brand_id;

        if (model_id != 0)
            url += '&model='+model_id;

        let loc = $("#inv_emp_rech_local_id").val();
        if (loc != "0")
            url += "&loc="+loc;

        window.location.href = url

    });

    /** ************************************* */

    $("#btn_consummation_type_consumable_id").on('click', function(){
        const value = $("#consummation_type_consumable_id").val();
        let url = '/furnitures/consummations/filter/type/'+value;

        window.location.href = url;

    });

    $("#btn_consummation_consumable_id").on('click', function(){
        const value = $("#consummation_consumable_id").val();
        let url = '/furnitures/consummations/filter/consumable/'+value;

        window.location.href = url;

    });

    $("#btn_consummation_employee_id").on('click', function(){
        const value = $("#consummation_employee_id").val();
        let url = '/furnitures/consummations/filter/employee/'+value;

        window.location.href = url;

    });

    $("#btn_consummation_service_id").on('click', function(){
        const value = $("#consummation_service_id").val();
        let url = '/furnitures/consummations/filter/service/'+value;

        window.location.href = url;

    });

    $("#btn_consummation_entity_id").on('click', function(){
        const value = $("#consummation_entity_id").val();
        let url = '/furnitures/consummations/filter/entity/'+value;

        window.location.href = url;

    });

    $("#btn_consummation_sercter_id").on('click', function(){
        const value = $("#consummation_sercter_id").val();
        let url = '/furnitures/consummations/filter/secter/'+value;

        window.location.href = url;

    });

    $("#btn_consummation_section_id").on('click', function(){
        const value = $("#consummation_section_id").val();
        let url = '/furnitures/consummations/filter/section/'+value;

        window.location.href = url;

    });

    $("#btn_consummation_local_id").on('click', function(){
        const value = $("#consummation_local_id").val();
        let url = '/furnitures/consummations/filter/local/'+value;

        window.location.href = url;

    });

    /** ************************************* */

    $("#btn_type_consumable_id").on('click', function(){
        const value = $("#type_consumable_id").val();
        let url = '/furnitures/stocks/filter/type/'+value;

        window.location.href = url;

    });

    $("#btn_consumable_id").on('click', function(){
        const value = $("#consumable_id").val();
        let url = '/furnitures/stocks/filter/consumable/'+value;

        window.location.href = url;

    });

    $("#btn_printer_model_material_id").on('click', function(){
        const value = $("#printer_model_material_id").val();
        let url = '/furnitures/stocks/filter/model/'+value;

        window.location.href = url;

    });

    $("#btn_big_printer_model_material_id").on('click', function(){
        const value = $("#big_printer_model_material_id").val();
        let url = '/furnitures/stocks/filter/model/'+value;

        window.location.href = url;

    });

    /** ********************************************************** **/
    $("#sl_inv_employee_id").on('change', function(){

        let employee_id = $("#sl_inv_employee_id").val();
        let url = '/inventories/create?emp='+employee_id;

        let material_id = $("#sl_inv_material_id").val();
        if (material_id != 0)
            url += '&mat='+material_id;

        let delivery_id = $("#sl_inv_model_material_id").val();
        if (delivery_id != 0)
            url += '&delv='+delivery_id;

        window.location.href = url;

    });

    $("#sl_inv_material_id").on('change', function(){

        let material_id = $("#sl_inv_material_id").val();
        let url = '/inventories/create?mat='+material_id;

        let employee_id = $("#sl_inv_employee_id").val();
        if (employee_id != 0) {
            url += '&emp='+employee_id;
        }

        let delivery_id = $("#sl_inv_model_material_id").val();
        if (delivery_id != 0)
            url += '&delv='+delivery_id;

        window.location.href = url;

    });

    /** ***************************************** **/

    $("#sl_inv_model_material_id").on('change', function(){
        const value = $(this).val();

        let url = "/inventories/create/?delv="+value;

        let employee_id = $("#sl_inv_employee_id").val();
        if (employee_id != 0) {
            url += '&emp='+employee_id;
        }

        let material_id = $("#sl_inv_material_id").val();
        if (material_id != 0)
            url += '&mat='+material_id;

        window.location.href = url;
    });

    /** ********************************************************** **/

    $("#sl_edit_service_entity_id").on('change', function(){
        const employee_id = $("#hid_employee_id").val();
        let service_id = $("#sl_edit_service_entity_id").val();
        let url = '/employees/'+employee_id+'/edit/prof/?srv='+service_id;
        window.location.href = url;

    });


    $("#sl_edit_entity_id").on('change', function(){
        const employee_id = $("#hid_employee_id").val();
        let entity_id = $("#sl_edit_entity_id").val();
        let service_id = $("#sl_edit_service_entity_id").val();
        let url = '/employees/'+employee_id+'/edit/prof/?srv='+service_id+'&ent='+entity_id;
        window.location.href = url;

    });

    /** ********************************************************** **/
    $("#sl_delivery_year").on('change', function(){
        const year = $(this).val();
        let url = '/furnitures/deliveries/?year='+year;
        window.location.href = url;
    });

    $("#sl_stock_delivery_year").on('change', function(){
        const year = $(this).val();
        let url = '/furnitures/stocks/?year='+year;
        window.location.href = url;
    });

});


