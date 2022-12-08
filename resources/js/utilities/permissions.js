export function userCan(props, permission) {
    let user = props?.auth?.user;
    let permissions = user?.can || [];

    return permissions.includes(permission);
}
