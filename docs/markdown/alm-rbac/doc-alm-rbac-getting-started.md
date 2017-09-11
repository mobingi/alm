 - Role Based Access Control (RBAC) is an advanced feature shipped with Mobingi Enterprise Edition.
 - This features is to help you centralize activities and assign role based access control to all members in your organization. It allowing you securely control access to all resources for your users.

## Getting Started

### Create Roles

 - Create roles can be done by master account only.
 - Create roles action can be performed through CLI, API or UI.
 - Editing roles is simple and straightforward. All users under your master account will be able to view their roles that assigned to them.

### Attach Roles to a User

 - Role works on users and attached by master account.
 - Currently, users can be assigned single role only.
 - Multiple roles to be attached with a single user will be available in our future releases.

### End User Effect

 - When users login to Mobingi ALM dashboard (or interacting through CLI or API), roles that attached to them will be evaluated first.
 - If an action isn't granted by the role definition, such action will be denied by RBAC.
 - If an action is grated by the role definition, the action will be performed.
