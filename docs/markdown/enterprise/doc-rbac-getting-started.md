 - Role Based Access Control (RBAC) feature is shipped with Mobingi Enterprise Edition.
 - RBAC feature is to help you centralize activities and assign role based access control to all members in your organization. It allowing you securely control access to all resources for your users.

### Create Roles

 - Create roles can be done by master account only.
 - Create roles action can be performed through CLI, API or UI.
 - Editing roles is simple and straightforward. All users under your master account will be able to view their roles that assigned to them.

### Attach Roles to User

 - Role works on users and assigned by master account.
 - Currently, users can be attached with single role only.
 - Multiple roles support will be available in our future releases.

### End User Effect

 - When users login to Mobingi ALM dashboard (or interacting through CLI or API), roles that attached to them will be evaluated on every action request.
 - If an action isn't granted by the role definition, such action will be denied.
 - If an action is grated by the role definition, the action will be allowed.
