

$(function () {

    // 编辑
    var edit = function (that) {
        that.parent().parent().find('label.text').addClass('edit').find('input').removeAttr('disabled')
        $('.rule-edit').addClass('hide')
        $('.rule-edit').siblings().removeClass('hide')
    }
    // 取消编辑
    var cancel_edit = function (that) {
        that.parent().parent().find('label.text').removeClass('edit').find('input').attr('disabled',true);
        $(".rule-edit").removeClass('hide');
        $('.rule-edit').siblings().addClass('hide')
    }

    // 点击编辑
    $(document).on("click",'.rule-edit',function () {
        var that = $(this);
        edit(that)
    })

    // 点击完成
    $(document).on("click",'.rule-confirm', function () {
        var that = $(this)

        var san = jeBox.loading(2,"Loading...");
        // 获取数据
        var value = that.parentsUntil("#tbody").getValue()

        // 更新规则
        MD.ajax_post({
            url: '/123/d',
            data: value
        },function (res) {
            jeBox.close(san);
            jeBox.msg("编辑成功",{"icon": 1, "time": 1});
            cancel_edit(that);

        },function(){
            jeBox.close(san);
        })

    })

    // 点击取消
    $(document).on('click','.rule-cancel', function () {
        cancel_edit($(this))
    });

    /**
     * ==== 新建规则 =====
     */
    // 点击新建规则
    $('#createNewRule').on('click',function () {
        var tmp = $("#create-template").html();
        $(tmp).attr("id",'0')

        $("#tbody").append($(tmp))

        MD.input_number();
    })

    // 新建完成
    $(document).on("click",'.create-rule-confirm', function () {
        var that = $(this)
        var san = jeBox.loading(2,"Loading...");

        var value = $(this).parentsUntil("#tbody").getValue()
        console.log(value)

        MD.ajax_post({
            url: '',
            data: value
        }, function (res) {
            jeBox.close(san);
            jeBox.msg("新建规则成功",{"icon": 1, "time": 1});

            // 返回新数据的id
            var id = res.id
            var opt_html = '<a data-id="'+ id +'" class="rule-edit">编辑</a>' +
                '<a data-id="'+ id +'" class="rule-confirm hide">完成</a>' +
                '<a data-id="'+ id +'" class="rule-cancel hide">取消</a>'
            that.parent().html(opt_html)

            cancel_edit(that)

        },function () {
            jeBox.close(san);
        })


    })

    // 新建取消
    $(document).on("click",'.create-rule-cancel', function () {
        $(this).parentsUntil("#tbody").remove();
    })

})
