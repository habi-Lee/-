const Index = {
    data: {},
    func: {
        getUserList: function () {
            fetch('../../apis/admin/getUserList.php', {
                method: 'GET',
                mode: 'cors',
                credentials: 'include'
            }).then(response => {
                return response.json()
            }).then(
                data => {
                    let userList = document.querySelector("#userList");

                    data.forEach(v => {
                        //判断今天是否打卡，根据接口反馈的1和0写入是或者否
                        if (v[2] == 1) {
                            isSign = '是';
                        } else {
                            isSign = '否';
                        }
                        userList.innerHTML += `
                        <tr>
                            <th scope="row">${v[0]}</th>
                            <td>${v[1]}</td>
                            <td>${isSign}</td>
                            <td>${v[3]}</td>
                        </tr>
                    `;
                    });

                    console.log(data)
                }
            )

        },
        getAdminName: function () {
            fetch('../../apis/admin/getAdminName.php').then().then()
        }
    }
}