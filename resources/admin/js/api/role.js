import request from '@/admin/js/utils/request';
import Resource from '@/admin/js/api/resource';

class RoleResource extends Resource {
  constructor() {
    super('roles');
  }

  permissions(id) {
    return request({
      url: '/' + this.uri + '/' + id + '/permissions',
      method: 'get',
    });
  }
}

export { RoleResource as default };
